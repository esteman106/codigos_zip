<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class CodigosController extends Controller
{
    public function consultaZipCodes(string $zip_code){
            $query = "CALL consulta_procedimiento( :codigo_zip )";
            $parametros['codigo_zip'] = $zip_code;

            $datadb = DB::select($query, $parametros);
            $data = self::crearArregloJson($zip_code, $datadb);

            return response()->json($data);
    }

    private function crearArregloJson(string $codigo,array $data){
        if (count($data) > 0){
            $final["zip_code"] = $codigo;
            foreach ($data as $key => $values){
                $final["locality"] = strtoupper($values->d_ciudad);
                $final["federal_entity"]["key"] = intval($values->c_estado);
                $final["federal_entity"]["name"] = strtoupper($values->d_estado);

                $final["settlements"][$key] = [
                    "key"=> intval($values->id_asenta_cpcons),
                    "name"=> strtoupper($values->d_asenta),
                    "zone_type"=> strtoupper($values->d_zona),
                    "settlement_type"=>[
                        "name"=> $values->d_tipo_asenta,
                    ]
                ];
                $final["municipality"]["key"] = intval($values->c_mnpio);
                $final["municipality"]["name"] = strtoupper($values->d_mnpio);
            }
        }else{
            $final = ['code' => 404,'message' => 'Not Found.'];
        }
        return $final;
    }
}
