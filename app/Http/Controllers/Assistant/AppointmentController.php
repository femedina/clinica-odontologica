<?php

namespace App\Http\Controllers\Assistant;

use App\User;
use App\Patient; 
use App\Appointment; 
use Illuminate\Http\Request;
use App\Http\Requests\AppointmentStoreRequest;
use App\Http\Requests\AppointmentUpdateRequest;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\MessageBag;
use App\Http\Controllers\Controller;
 
class AppointmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        /*$appointments = DB::table('appointments as a')
            ->where(function ($query) {
                $query->where('a.appointer_id', '=',Auth::user()->id)
                      ->orWhere('a.appointer_id', '=',Auth::user()->assigned_doctor_id);
            })
            ->leftjoin('patients as b','a.patient_id','=','b.id')
            ->leftjoin('users as c','a.doctor_id','=','c.id')
            ->leftjoin('users as d','a.appointer_id','=','d.id')
            ->where('a.date','like','%'.$search.'%')
            ->orWhere('a.description','like','%'.$search.'%')
            ->orwhere('b.name', 'like', '%'.$search.'%')
            ->whereNull('a.deleted_at')
            ->select('a.*', 'b.name as namepatient','b.email as email','d.name as nameuser')
            ->limit(15)
            ->get();*/

        $appointments = Appointment::where('doctor_id',Auth::user()->assigned_doctor_id)
            ->orderBy('created_at','desc')
            ->search($search)
            ->paginate(20);


        return view('assistant.appointments',compact('appointments','search'));
    }





    /**
  

     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    { 
        #$search = $request->input('filtro');
        $patients = Patient::orderBy('name','asc')
        #->patforapp($search) //patforapp= patient for appointment
        ->paginate(10);
        return view('assistant.create_appointment',compact('patients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentStoreRequest $request)
    {

        $errors = new MessageBag;

        $date = $request->input('date');
        $fecha=array();
        $hora=array();
        preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/', $date, $fecha); //extrae fecha cita
        preg_match('/([0-9]{2}:)(?=[0-9]{2})/', $date, $hora); //extrae hora cita
        $citas = DB::table('appointments as a')
            ->where('a.date','like','%'.$hora[0].'%__:%__') //'%18:%__:%__'
            ->Where('a.date','like','%'.$fecha[0].'%') //'%2019-05-02%'
            ->where(function ($query) {
                $query->where('a.appointer_id', '=',Auth::user()->id)
                      ->orWhere('a.appointer_id', '=',Auth::user()->assigned_doctor_id);
            })
            ->select('a.date')
            ->get();

        $arr=array();
        foreach ($citas as $key => $dates) {
            $arr[]=$dates;
        }

        if (sizeof($arr)==0){
            $appointment = new Appointment([
                            'appointer_id'=>Auth::user()->id,
                            'doctor_id'=>Auth::user()->assigned_doctor_id,
                            'patient_id'=>$request->input('patient_id'),
                            'date'=>$request->input('date'),
                            'description'=>$request->input('description')

                        ]);           
            $appointment->save();
            return redirect()->route('assistant appointments');
        }else{
            $patient_old = $request->input('patient_id');
            $description_old = $request->input('description');

            // definir nombre de la variable y mensaje de error:     
            $errors->add('exist', 'Existe una cita guardada a esa hora ');
            // estos no son errores, lo hago para capturar lo datos enviados y reinsertarlos al formulario
            $errors->add('date_old', $date);
            $errors->add('patient_old',$patient_old);
            $errors->add('description_old', $description_old);

            return redirect()->route('assistant create appointment')->withErrors($errors);
        }

    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment=Appointment::find($id);
        return view('assistant.edit_appointment',compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentUpdateRequest $request, Appointment $appointment)
    {
        $appointment->update($request->except(['']));
        return redirect()->route('assistant appointments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        $appointment->delete();
        return redirect()->route('assistant appointments');
    }
}
