<?php
// ***********
// by lucas de freitas github: https://github.com/lucas-tagdev
// ***********
namespace App\Http\Controllers;
use App\Models\Device;
use App\Models\Web;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class WebController extends Controller
{
    //index
    public function index()
    {
        //Modo de busca utilizando LIKE
        $projects = Device::all();
        $term = 'Notebook';
        $filterData = DB::table('devices')->where('type','LIKE','%'.$term.'%')->get();

        //desktop
        $term2 = 'PC';
        $filterData2 = DB::table('devices')->where('type','LIKE','%'.$term2.'%')->get();

        //impressora
        $term3 = 'Impressora';
        $filterData3 = DB::table('devices')->where('type','LIKE','%'.$term3.'%')->get();

        //monitores
        $term4 = 'monitor';
        $filterData4 = DB::table('devices')->where('type','LIKE','%'.$term4.'%')->get();

        //scanners
        $term5 = 'Scanner';
        $filterData5 = DB::table('devices')->where('type','LIKE','%'.$term5.'%')->get();

        //2 tipo de busca utilizando eloquent
        // Buscar apenas notebooks
        $n_tipo = Device::where('type','notebook')->get();
        $note_count = count($n_tipo); 

        // Buscar apenas desktops
        $n_tipo2 = Device::where('type','PC')->get();
        $desk_count = count($n_tipo2);

        // Buscar apenas monitores
        $n_tipo3 = Device::where('type','monitor')->get();
        $monitor_count = count($n_tipo3);

        // Buscar apenas impressoras
        $n_tipo4 = Device::where('type','impressora')->get();
        $print_count = count($n_tipo4);

        // Buscar apenas scanners
        $n_tipo5 = Device::where('type','scanner')->get();
        $scan_count = count($n_tipo5);


        // Buscar apenas os dispositivos em uso
        $emuso = Device::where('status','em uso')->get();
        $emuso_count = count($emuso);

        // Buscar apenas os dispositivos em conserto
        $conserto = Device::where('status','conserto')->get();
        $conserto_count = count($conserto);

        // Buscar apenas os dispositivos em danificado
        $danificado = Device::where('status','danificado')->get();
        $danificado_count = count($danificado);
        

        $year = ["Notebook", "Desktop", "Monitor", "Impressora", "Scanners"];
        

        return view('home', compact('projects', 'filterData', 'filterData2', 'filterData3', 'filterData4', 'filterData5', 'note_count', 'desk_count', 'monitor_count', 'print_count', 'scan_count', 'emuso_count', 'conserto_count', 'danificado_count'))->with('year',json_encode($year,JSON_NUMERIC_CHECK));
        
    }

    public function create()
    {
        return view('create');
    }

    //Essa função vai criar os Dispositivos e salvar as imagens
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
    
        $device = Device::create($input);

        //dd($device);
        return redirect()->route('web.index')
                        ->with('success','Device adicionado com sucesso');

    }

    //Essa função irá mostrar detalhes do Dispositivo criado.
    public function show($device_id)
    {
        $product = Device::find($device_id);
        return view('show',compact('product'));
    }

    ////Essa função chamara nosso formulario para editar o nosso Dispositivo
    public function edit($device_id)
    {
        $device = Device::find($device_id);
        return view('edit',compact('device'));
    }

    //Essa função como o proprio nome ja diz irá atualizar o nosso Dispositivo
    public function update(Request $request, Device $device)
    {

        
        $input = $request->all();
        
    

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
        
            
    
        return redirect()->route('web.index')
                        ->with('success','Device atualizado com sucesso');
    }

    //A função final seria para deletar o Dispositivo
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
    //by lucas de freitas github: https://github.com/lucas-tagdev
}
