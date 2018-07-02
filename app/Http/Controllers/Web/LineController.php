<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Line;
use App\Models\Package;
use App\Tools\Robot;
use Validator;
use Redirect;
use Auth;

class LineController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function showManageLines()
    {
        $lines=Auth::user()->lines()->get();
        return view('dashboard.managelines', ['lines' => $lines]);
    }

    public function ShowAddForm()
    {
        $packages = Package::all();
        return view('dashboard.createline', ['packages' => $packages]);
    }

    public function storeLine(Request $request)
    {
        $validator=Validator::Make($request->all(),
            [
                'username' => 'required|min:6|max:255|unique:lines',
                'password' => 'required|min:6|max:20',
                'package_id' => 'required|numeric',
                'reseller_notes' => ''
            ]
        )->validate();
        $data=[
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'package_id' => $request->input('package_id'),
            'reseller_notes' => $request->input('reseller_notes')
        ];
        if(Robot::AddLine($data))
        {
            $user=Auth::user();
            $lineaddedID=Robot::GetLineIdByName($request->input('username'));
            $line = new Line();
            $line->user_id = $user->id;
            $line->line_id = $lineaddedID;
            $line->username = $request->input('username');
            $line->password = $request->input('password');
            $line->package_id = $request->input('package_id');
            $line->reseller_notes = $request->input('reseller_notes');
            $line->save();
            return Redirect::back()->with('status', 'Linea creada correctamente.');
        }
        else {
            return Redirect::back()->with('error', 'No se logro crear la linea.');
        }
    }

    public function ShowEditForm($idLine)
    {
        $line=Auth::user()->lines()->find($idLine);
        return view('dashboard.editline', ['line' => $line]);
    }

    
    public function updateLine(Request $request, $idLine)
    {
        $validator=Validator::Make($request->all(),
            [
                'password' => 'required|min:6|max:20',
                'reseller_notes' => ''
            ]
        )->validate();

        $line=Auth::user()->lines()->find($idLine);

        $data=[
            'line_id' => $line->line_id,
            'password' => $request->input('password'),
            'reseller_notes' => $request->input('reseller_notes')
        ];
        if(Robot::EditLine($data))
        {
            $line->password = $request->input('password');
            $line->reseller_notes = $request->input('reseller_notes');
            $line->save();
            return Redirect::back()->with('status', 'Informacion de Linea actualizada.');
        }
        else {
            return Redirect::back()->with('error', 'No se pudo actualizar.');
        }
    }

    public function ShowExtendform()
    {
        $lines=Auth::user()->lines()->get();
        $packages = Package::all();
        return view('dashboard.extendline', ['lines' => $lines, 'packages' => $packages]);
    }

    public function extend(Request $request)
    {
        $validator=Validator::Make($request->all(),
            [
                'line_id' => 'required|numeric',
                'package_id' => 'required|numeric'
            ]
        )->validate();
        $data=[
            'line_id' => $request->input('line_id'),
            'package_id' => $request->input('package_id')
        ];
        if(Robot::ExtendLine($data))
        {
            $line = Line::where('line_id', $request->input('line_id'))->first();
            $line->package_id = $request->input('package_id');
            $line->save();
            return Redirect::back()->with('status', 'Se ha extendido la linea.');
        }
        else {
            return Redirect::back()->with('error', 'No se logro extender la linea.');
        }
    }
    
    public function deleteLine($line)
    {
        if(Auth::user()->isAdmin())
        {
            $line=Line::all()->find($line);
            if(Robot::DeleteLine(['line_id'=>$line->line_id]))
            {
                $line->delete();
                return response()->json(['message' => 'Linea borrada.', 'code' => 204], 200);
            }
            else {
                return response()->json(['message' => 'No se ha podido borrar.', 'code' => 304], 200);
            }
        }
        else {
            $line=Auth::user()->lines()->find($line);
            if(Robot::DeleteLine(['line_id'=>$line->line_id]))
            {
                $line->delete();
                return response()->json(['message' => 'Linea borrada.', 'code' => 204], 200);
            }
            else {
                return response()->json(['message' => 'No se ha podido borrar.', 'code' => 304], 200);
            }
        }
    }

}
