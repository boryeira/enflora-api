<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Users\Prescription;
// use Redirect;
use Auth;
use Response;
// use Session;
use Validator;
use Storage;
use Image;



class PrescriptionController extends ApiController
{

  public function index()
  {
      $user = Auth::user();
      $prescriptions = $user->prescriptions;
      return $this->showAll($prescriptions);
  }

  public function active()
  {
      $user = Auth::user();
      $prescription = $user->activePrescription;
      if($prescription) {
        return $this->showOne($prescription);
      } else {
        return response()->json(null, 200);
      }
      
  }

  public function store(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'prescription' => 'file|required',
    ]);

    if ($validator->fails()) {
      return response()->json(['error' => 'imagen no valida'], 400 );
    } else {
      $prescription = new Prescription;
      $prescription->user_id = Auth::user()->id;
      $prescription->status = 1;
      $prescription->save();

      $resize = Image::make($request->prescription)->encode('jpg');
      $storage = Storage::put('public/user/'.Auth::user()->id.'/prescription/'.$prescription->id.'.jpg', $resize);
      $prescription->file = url('/').'/storage/user/'.Auth::user()->id.'/prescription/'.$prescription->id.'.jpg';
      $prescription->save();
      return $this->showOne($prescription);
    }

  }


}
