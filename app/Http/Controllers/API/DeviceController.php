<?php
// ***********
// by lucas de freitas github: https://github.com/lucas-tagdev
// ***********
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
 
use App\Models\Device;
 
use Validator;

class DeviceController extends Controller
{
    //Essa função vai listar os orcamentos criados
    public function index()
    {
        $devices = Device::all();
     
        return response()->json(
            /*"success" => true,
            "message" => "Lista de orcamentos",
            "data" => $devices*/
            $devices
        );
    }

    //Essa função vai criar os orcamentos e salvar as imagens
    public function store(Request $request)
    {

        $input = $request->all();
    
        

        //Aqui vamos salvar a imagem em nosso servidor
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = $image->getClientOriginalName();                    
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $input['image'] = $name;
        }

        /*
        $uploadFolder = 'users';
        $image = $request->file('image');
        $image_uploaded_path = $image->store($uploadFolder, 'public');
        $uploadedImageResponse = array(
            "image_name" => basename($image_uploaded_path),
            "image_url" => Storage::disk('public')->url($image_uploaded_path),
            "mime" => $image->getClientMimeType()
        );
        */
    
        $device = Device::create($input);

        //dd($device);
        return response()->json([
            "success" => true,
            "message" => "Dispositivo adicionado.",
            "data" => $device
        ]);

    }

    //Essa função irá mostrar detalhes do orcamento criado.
    public function show($id)
    {
        $device = Device::find($id);
   
        if (is_null($device)) {
            return $this->sendError('Dispositivo nao encontrado.');
        }
         
        return response()->json([
            "success" => true,
            "message" => "Dispositivo recuperado com sucesso",
            "data" => $device
        ]);
 
    }

    //Essa função como o proprio nome ja diz irá atualizar o nosso orcamento
    public function atualizar(Request $request)
    {
        $input = $request->all();
        
    
        $validator = Validator::make($input, [
            //'name' => 'required',
            //'detail' => 'required',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        //Vamos salvar a imagem em nosso servidor caso tenha sido enviad pelo o usuário
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = $image->getClientOriginalName();                    
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $input['image'] = $name;
            
            
            $device = Device::find($request->id);

            //'patri', 'sn', 'name', 'user', 'setor', 'brand', 'model', 'type', 'status', 'image'
            $device->patri = $input['patri'];
            $device->sn = $input['sn'];
            $device->name = $input['name'];
            $device->user = $input['user'];
            $device->setor = $input['setor'];
            $device->brand = $input['brand'];
            $device->model = $input['model'];
            $device->type = $input['type'];
            $device->status = $input['status'];
            $device->image = $input['image'];
            
            $device->save();
        
            return response()->json([
                "success" => true,
                "message" => "Dispositivos atualizado.",
                "data" => $device
            ]);

        }

            $device = Device::find($request->id);
    
            $device->patri = $input['patri'];
            $device->sn = $input['sn'];
            $device->name = $input['name'];
            $device->user = $input['user'];
            $device->setor = $input['setor'];
            $device->brand = $input['brand'];
            $device->model = $input['model'];
            $device->type = $input['type'];
            $device->status = $input['status'];
            
            $device->save();
        
            return response()->json([
                "success" => true,
                "message" => "Dispositivo atualizado.",
                "data" => $device
            ]);
    }

    //A função final seria para deletar o orcamento
    public function destroy($id)
    {
        $device = Device::find($id);
        $device->delete();
    
        return response()->json([
            "success" => true,
            "message" => "Dispositivo deletado.",
            "data" => $device
        ]);
    }
}