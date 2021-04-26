<?php
namespace App\Cities;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

//injeção da model
use App\Models\Cities;


class apiController extends Controller
{

    public function index()
    {
        //irá mostrar todos dados da tabela citie
        $Cites = Cities::all();
        return $Cites;
    }

    public function store(Request $request)
    {
        $city = Cities::create($request->all());
        return $city;
       /**  $cities = $request->isMethod('put')? Cities::findOrFail($request->cities_id): new Cities;
        $cities->$id = $request->input('id');
        $cities->$id = $request->input('name');
        $cities->$id = $request->input('latitude');
        $cities->$id = $request->input('longitude');
        $cities->$id = $request->input('gmt');

        if($cities->save()){
            return $cities;
        }
    */
    }

    public function show($id)
    {
        $city = Cities::findOrFail($id);
        return $city;
    }

    public function update(Request $request, $id)
    {
        $city = Cities::findOrFail($id);
        $city->update($request->all());
        return $city;
    }

    public function destroy($id)
    {
        $city = Cities::findOrFail($id);
        $city->delete();
        /**if($city->delete()){
            return $city;
        }*/
    }

    public function getData(Request $request)
    {
            $URI = "https://api.openweathermap.org/data/2.5/";
            $api_key;
            $data;
            /**
             * GET api call
             * @param string $url
             * @param array $params
             * @return string
             * @throws Exception
             */
            public function apiCall($url, $params = array())
            {
                $data = null;
                $url = (self::URI . $url);
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_TIMEOUT, 3);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                if (!empty($params)) {
                    $url = ($url . '?appid=' . $this->api_key . '&' . str_replace('%2C', ',', http_build_query($params, null)));
                } else {
                    throw new Exception('params was empty');
                }
                curl_setopt($curl, CURLOPT_URL, $url);
                $response = curl_exec($curl);
                $responseInfo = curl_getinfo($curl);
                switch ($responseInfo['http_code']) {
                    case 0:
                        throw new Exception('Timeout reached when calling ' . $url);
                        break;
                    case 200:
                        $data = $response;
                        break;
                    case 401:
                        throw new Exception('Unauthorized request to ' . $url . ': ' . json_decode($response)->message);
                        break;
                    case 404;
                        $data = null;
                        break;
                    default:
                        throw new Exception('Connect to API failed with response: ' . $responseInfo['http_code']);
                        break;
                }
                $this->data = $data;
                return $data;
            }
            /**
             * Generates a call with parameters
             * @param string $base
             * @param array $params
             * @return string
             */
            public function generateCall($base, $params)
            {
                return $this->apiCall($base, $params);
            }
            /**
             * Access values from current data
             */
            public function readCurrentData()
            {
                $data = json_decode($this->data, true);
                $temp = $data['main']['temp'];
                $max_temp = $data['main']['temp_max'];
                $min_temp = $data['main']['temp_min'];
                $pressure = $data['main']['pressure'];
                $humidity = $data['main']['humidity'];
                $wind_speed = $data['wind']['speed'];
                $wind_direction = $data['wind']['deg'];
                $call_id = $data['sys']['id'];
                $clouds = $data['clouds']['all'];
                $main = $data['weather'][0]['main'];
                $desc = $data['weather'][0]['description'];
                $icon = $data['weather'][0]['icon'];
                if (isset($data['rain']['3h'])) {
                    $rain3h = $data['rain']['3h'];
                } else {
                    $rain3h = 0;
                }
            }
            /**
             * Access values from forecast data
             */
            public function readForecastData()
            {
                $data = json_decode($this->data, true);
                foreach ($data['list'] as $val) {
                    $main = $val['main'];
                    $temp = $main['temp'];
                    $date = $val['dt_txt'];
                    $pressure = $main['pressure'];
                    $humidity = $main['humidity'];
                    $wind_speed = $val['wind']['speed'];
                    $wind_direction = $val['wind']['deg'];
                    $clouds = $val['clouds']['all'];
                    $weather = $val['weather'][0];
                    $main = $weather['main'];
                    $icon = $weather['icon'];
                }
            }
    }
}
