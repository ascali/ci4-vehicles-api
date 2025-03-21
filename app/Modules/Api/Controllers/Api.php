<?php

namespace App\Modules\Api\Controllers;

use App\Modules\Api\Models\ApiModel;
use App\Core\BaseController;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use GuzzleHttp\Client;
use CodeIgniter\HTTP\CURLRequest;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class Api extends BaseController
{
    private $apiModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->apiModel = new ApiModel();
    }

    public function index(): ResponseInterface
    {
        return $this->response->setJSON([
            'status_code' => 200,
            'error' => false,
            'message' => "Welcome to API",
            'data' => []
        ]);
    }

    public function test()
    {
        return 'test ';
    }

    public function data_eksekutif()
    {
        $baseUrlNgi = getenv('prop.BASE_URL_NGI');
        $token_ngi = $this->request->token_ngi;
        $type_token = $this->request->type_token;
        
        $currentDate = new \DateTime();
        $start_date = (new \DateTime($currentDate->format('Y-m-d')))->modify('monday this week')->format('Y-m-d');
        $end_date = (new \DateTime($currentDate->format('Y-m-d')))->modify('sunday this week')->format('Y-m-d');
        
        $client = \Config\Services::curlrequest();
        $response = $client->post(
            $baseUrlNgi . "/api/openJatim/v1/dataEksekutifJatim",
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => $type_token . ' ' . $token_ngi
                ],
                'json' => [
                    "start_date" => $start_date,
                    "end_date" => $end_date
                ]
            ]
        );

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            $resultData = [];
            $dateRange = new \DatePeriod(
                new \DateTime($start_date),
                new \DateInterval('P1D'),
                (new \DateTime($end_date))->modify('+1 day')
            );

            foreach ($dateRange as $date) {
                $formattedDate = $date->format('Y-m-d');
                $found = false;
                for ($i = 0; $i < count($data['data']); $i++) {
                    $item = $data['data'][$i];
                    if ($item['tanggal'] == $formattedDate) {
                        $resultData[] = $item;
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $resultData[] = [
                        'tanggal' => $formattedDate,
                        'jml_pendapatan' => "0",
                        'jml_penumpang' => "0"
                    ];
                }
            }
            return $this->response->setJSON([
                'status_code' => 200,
                'error' => false,
                'message' => "Successfully",
                'data' => $resultData,
                'range' => [
                    "start_date" => $start_date,
                    "end_date" => $end_date
                ]
            ]);
        }

        return $this->response->setJSON([
            'status_code' => 500,
            'error' => true,
            'message' => "Internal Server Error"
        ], 500);
    }
    
    public function data_aduan() {
        $baseUrlNgi = getenv('prop.BASE_URL_NGI');
        $token_ngi = $this->request->token_ngi;
        $type_token = $this->request->type_token;

        $page = $this->request->getGet('page') ?? 1;
        $sort = $this->request->getGet('sort') ?? 'desc';
        $aduan_reply = $this->request->getGet('aduan_reply') ?? 'null';
        $limit = $this->request->getGet('limit') ?? 10;
    
        $client = \Config\Services::curlrequest();
        $response = $client->get($baseUrlNgi . "/api/openJatim/v1/dataAduanJatim", [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => $type_token . ' ' . $token_ngi
            ],
            'query' => [
                'page' => $page,
                'sort' => $sort,
                'limit' => $limit,
                'aduan_reply' => $aduan_reply
            ]
        ]);
        // Log the request details
        // log_message('debug', 'Response Status Code: ' . $response->getStatusCode());
        // log_message('debug', 'Response Body: ' . $response->getBody());
    
        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            return $this->response->setJSON([
                'status_code' => 200,
                'error' => false,
                'message' => "Successfully",
                'data' => $data['data'],
                'pagination' => $data['pageInfo']
            ]);
        }
        return $this->response->setJSON([
            'status_code' => 500,
            'error' => true,
            'message' => "Internal Server Error"
        ], 500);
    }

    public function data_aduan_detail() {
        $baseUrlNgi = getenv('prop.BASE_URL_NGI');
        $token_ngi = $this->request->token_ngi;
        $type_token = $this->request->type_token;

        $aduan_id = $this->request->getGet('aduan_id');
    
        $client = \Config\Services::curlrequest();
        $response = $client->get($baseUrlNgi . "/api/openJatim/v1/aduanJatimById", [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => $type_token . ' ' . $token_ngi
            ],
            'query' => [
                'aduan_id' => $aduan_id
            ]
        ]);
    
        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            return $this->response->setJSON([
                'status_code' => 200,
                'error' => false,
                'message' => "Successfully",
                'data' => $data['data'][0]
            ]);
        }
        return $this->response->setJSON([
            'status_code' => 500,
            'error' => true,
            'message' => "Internal Server Error"
        ], 500);
    }

    public function balas_aduan() {
        $baseUrlNgi = getenv('prop.BASE_URL_NGI');
        $token_ngi = $this->request->token_ngi;
        $type_token = $this->request->type_token;
    
        $id_aduan = $this->request->getPost('id_aduan');
        $reply_text = $this->request->getPost('reply_text');
    
        $client = \Config\Services::curlrequest();
        $response = $client->post($baseUrlNgi . "/api/openJatim/v1/replyAduanJatim", [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => $type_token . ' ' . $token_ngi
            ],
            'form_params' => [
                'id_aduan' => $id_aduan,
                'reply_text' => $reply_text
            ]
        ]);
    
        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            return $this->response->setJSON([
                'status_code' => 200,
                'error' => false,
                'message' => "Successfully",
                'data' => $data
            ]);
        }
        return $this->response->setJSON([
            'status_code' => 500,
            'error' => true,
            'message' => "Internal Server Error"
        ], 500);
    }

    public function data_terminal()
    {
        $token_ngi = $this->request->token_ngi;
        $baseUrlNgi = getenv('prop.BASE_URL_NGI');
    
        $client = \Config\Services::curlrequest();
        $response = $client->get(
            $baseUrlNgi . "/api/openJatim/v1/dataTerminalJatim",
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $token_ngi
                ]
            ]
        );
    
        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            return $this->response->setJSON([
                'status_code' => 200,
                'error' => false,
                'message' => "Successfully",
                'data' => $data['data']
            ]);
        }
    
        return $this->response->setJSON([
            'status_code' => 500,
            'error' => true,
            'message' => "Internal Server Error"
        ], 500);
    }

    public function data_perlintasan_kai()
    {
        $token_ngi = $this->request->token_ngi;
        $baseUrlNgi = getenv('prop.BASE_URL_NGI');
    
        $client = \Config\Services::curlrequest();
        $response = $client->get(
            $baseUrlNgi . "/api/openJatim/v1/perlintasan_kai",
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $token_ngi
                ]
            ]
        );
    
        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            return $this->response->setJSON([
                'status_code' => 200,
                'error' => false,
                'message' => "Successfully",
                'data' => $data['data']
            ]);
        }
    
        return $this->response->setJSON([
            'status_code' => 500,
            'error' => true,
            'message' => "Internal Server Error"
        ], 500);
    }

    public function data_traffic_google()
    {
        $latlong_origin = $this->request->getPost('origin');
        $latlong_destination = $this->request->getPost('destination');

        $client = \Config\Services::curlrequest();
        $response = $client->post(
            'https://maps.googleapis.com/maps/api/directions/json',
            [
                'query' => [
                    'origin' => $latlong_origin,
                    'destination' => $latlong_destination,
                    'departure_time' => 'now',
                    'language' => 'en',
                    'mode' => 'driving',
                    'region' => 'id',
                    'traffic_model' => 'best_guess',
                    'key' => 'AIzaSyAF6Ork37kgdS-kf4wMTUSZS2rcUDMEyek'
                ]
            ]
        );

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            return $this->response->setJSON([
                'status_code' => 200,
                'error' => false,
                'message' => "Successfully",
                'data' => $data
            ]);
        }

        return $this->response->setJSON([
            'status_code' => 500,
            'error' => true,
            'message' => "Internal Server Error"
        ], 500);
    }

    public function data_nominatim_query()
    {
        $query = $this->request->getGet('query');
        
        $client = new Client();
        $response = $client->get(
            'https://nominatim.openstreetmap.org/search.php',
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'User-Agent' => 'Thishub/1.0'
                ],
                'query' => [
                    'q' => $query,
                    'polygon_geojson' => 1,
                    'bounded' => 1,
                    'accept-language' => 'id',
                    'countrycodes' => 'id',
                    'format' => 'jsonv2'
                ]
            ]
        );
    
        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            return $this->response->setJSON([
                'status_code' => 200,
                'error' => false,
                'message' => "Successfully",
                'data' => $data
            ]);
        } elseif ($response->getStatusCode() == 403) {
            return $this->response->setJSON([
                'status_code' => 403,
                'error' => true,
                'message' => "Forbidden: The request is forbidden. Please check the query parameters and API usage."
            ], 403);
        } else {
            return $this->response->setJSON([
                'status_code' => 500,
                'error' => true,
                'message' => "Internal Server Error"
            ], 500);
        }
    }

    public function dataRoutes()
    {
        $baseUrlNgiGps = getenv('prop.BASE_URL_NGI_GPS');

        $client = \Config\Services::curlrequest();
        $response = $client->get(
            $baseUrlNgiGps . "/dev/api/jsonAllRoutesDemo",
            [
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ]
        );

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            return $this->response->setJSON([
                'status_code' => 200,
                'error' => false,
                'message' => "Successfully",
                'data' => $data['data']
            ]);
        }

        return $this->response->setJSON([
            'status_code' => 500,
            'error' => true,
            'message' => "Internal Server Error"
        ], 500);
    }

    public function data_all_bus()
    {
        $token_ngi = $this->request->token_ngi;
        $input = $this->request->getJSON(true);
        $key = $input['key'];
        $plat = $input['plat'];
        $pref = $input['pref'];
        $baseUrlNgiGps = getenv('prop.BASE_URL_NGI_GPS');
    
        $client = \Config\Services::curlrequest();
        $response = $client->post(
            $baseUrlNgiGps . ":8448/api/findAll",
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $token_ngi
                ],
                'json' => [
                    'key' => $key,
                    'plat' => $plat,
                    'pref' => $pref,
                ],
                'verify' => false
            ]
        );
    
        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            return $this->response->setJSON([
                'status_code' => 200,
                'error' => false,
                'message' => "Successfully",
                'data' => $data['data']
            ]);
        }
    
        return $this->response->setJSON([
            'status_code' => 500,
            'error' => true,
            'message' => "Internal Server Error"
        ], 500);
    }

    public function dataJsonRoadTraffic()
    {
        $roads = [
            [
                "id" => "14",
                "road_name" => "Jalan Raya Darmo Arah Utara",
                "latlng_start" => "-7.298417804962695,112.7377724647522",
                "latlng_end" => "-7.27756981697941,112.7412056922913"
            ],
            [
                "id" => "15",
                "road_name" => "Jalan Diponegoro",
                "latlng_start" => "-7.296060615576496,112.7389633655548",
                "latlng_end" => "-7.274978383699732,112.7264374494553"
            ],
            [
                "id" => "33",
                "road_name" => "Jalan Indragiri Surabaya",
                "latlng_start" => "-7.292687057890185,112.72974704392256",
                "latlng_end" => "-7.289377410682568,112.73149464977907"
            ],
            [
                "id" => "34",
                "road_name" => "Arif Rahman Hakim",
                "latlng_start" => "-7.2895151347298945,112.78042939491573",
                "latlng_end" => "-7.289898250963609,112.7856114227325"
            ],
            [
                "id" => "35",
                "road_name" => "Ahmad Yani - Jemursari",
                "latlng_start" => "-7.326711878406851,112.7317344560288",
                "latlng_end" => "-7.3273609933387736,112.73415380856024"
            ],
            [
                "id" => "37",
                "road_name" => "jl ahmad yani",
                "latlng_start" => "-7.30947461326819,112.73560523986818",
                "latlng_end" => "-7.326415794226283,112.73187160491945"
            ],
            [
                "id" => "39",
                "road_name" => "jl mayjend sungkono arah adityawarman",
                "latlng_start" => "-7.288249343966953,112.70719528198242",
                "latlng_end" => "-7.29270306253055,112.72964000701906"
            ],
            [
                "id" => "40",
                "road_name" => "jl mayjend sungkono arah hr muhammad",
                "latlng_start" => "-7.2928520511553,112.72954881191255",
                "latlng_end" => "-7.28845154481361,112.70715773105623"
            ],
            [
                "id" => "45",
                "road_name" => "Jl Blauran",
                "latlng_start" => "-7.258253435125853,112.73327708244325",
                "latlng_end" => "-7.256050357023381,112.73419976234437"
            ],
            [
                "id" => "52",
                "road_name" => "jl raya kedurus",
                "latlng_start" => "-7.310687759411204,112.71073043346406",
                "latlng_end" => "-7.313305589859519,112.70965218544006"
            ],
            [
                "id" => "53",
                "road_name" => "jl letnan jendral sutoyo",
                "latlng_start" => "-7.350326025563535,112.70845592021944",
                "latlng_end" => "-7.351278364627112,112.71239876747133"
            ],
            [
                "id" => "55",
                "road_name" => "Basuki Rahmat",
                "latlng_start" => "-7.266984045704738,112.7411323787965",
                "latlng_end" => "-7.264259517341903,112.74110019228831"
            ],
            [
                "id" => "57",
                "road_name" => "sample jalan",
                "latlng_start" => "-7.300652600586086,112.7373379468918",
                "latlng_end" => "-7.301381567219403,112.74278819561006"
            ],
            [
                "id" => "58",
                "road_name" => "Test jalan citra raya niaga",
                "latlng_start" => "-7.2826866232146035,112.64399034669626",
                "latlng_end" => "-7.283538005151735,112.65145761659369"
            ]
        ];

        return $this->response->setJSON([
            'status_code' => 200,
            'error' => false,
            'message' => "Successfully",
            'data' => $roads
        ]);
    }

    function upload_file() {
        $objAwsS3Client = new S3Client([
            'version' => 'latest',
            'region'  => getenv('prop.MINIO_DEFAULT_REGION'),
            'endpoint' => getenv('prop.MINIO_URL'),
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => getenv('prop.MINIO_ACCESS_KEY_ID'),
                'secret' => getenv('prop.MINIO_SECRET_ACCESS_KEY'),
            ],
        ]);

        $response = [
            'success' => false,
            'message' => '',
            'data' => []
        ];

        if (isset($_FILES['file'])) {
            $fileName = $_FILES['file']['name'];
            $fileTempName = $_FILES['file']['tmp_name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $newFileName = md5(time() . '_' . $fileName) . '.' . $fileExtension;

            $key = $newFileName;
            if (in_array($fileExtension, ['kml', 'kmz'])) {
                $key = 'kml_files/' . $newFileName;
            } else {
                $key = 'documents/' . $newFileName;
            }

            $contentType = mime_content_type($fileTempName);
           
            try {
                $result = $objAwsS3Client->putObject([
                    'Bucket' => getenv('prop.MINIO_BUCKET'),
                    'Key'    => $key,
                    'Body'   => fopen($fileTempName, 'r'),
                    'ACL'    => 'public-read',
                    'ContentType' => $contentType
                ]);
               
                $response['success'] = true;
                $response['message'] = 'File uploaded successfully.';
                if (in_array($fileExtension, ['kml', 'kmz'])) {
                    $geojson = $this->convert_kml_to_geojson($fileTempName);
                    $response['data'] = [
                        'file_url' => $result['ObjectURL'],
                        'file_key' => $key,
                        'geojson' => $geojson
                    ];
                } else {
                    $response['data'] = [
                        'file_url' => $result['ObjectURL'],
                        'file_key' => $key
                    ];
                }
            } catch (S3Exception $e) {
                $response['message'] = 'There was an error uploading the file: ' . $e->getMessage();
            }
        } else {
            $response['message'] = 'Input file dibutuhkan!';
        }

        $this->response->setHeader('Content-Type', 'application/json');
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function upload_kml() {
        $response = [
            'success' => false,
            'message' => '',
            'data' => []
        ];

        if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $fileTempName = $_FILES['file']['tmp_name'];
            $geojson = $this->convert_kml_to_geojson($fileTempName);
            
            $response['success'] = true;
            $response['message'] = 'File uploaded successfully.';
            $response['data'] = $geojson;
        } else {
            $response['success'] = false;
            $response['message'] = 'File upload failed!';
        }

        $this->response->setHeader('Content-Type', 'application/json');
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    private function convert_kml_to_geojson($fileTempName) {
        $kmlContent = file_get_contents($fileTempName);
        
        // Memuat KML menggunakan SimpleXML
        $xml = simplexml_load_string($kmlContent);
        $namespaces = $xml->getNamespaces(true);
        
        $geojson = [
            'type' => 'FeatureCollection',
            'features' => []
        ];
    
        // Mengambil semua 'Placemark' dalam KML
        foreach ($xml->Document->Placemark as $placemark) {
            $coordinates = [];
            $geometryType = 'Point'; // Default
    
            // Memproses koordinat berdasarkan jenis geometrinya
            if (isset($placemark->Point)) {
                $coords = trim((string) $placemark->Point->coordinates);
                $coordinates = array_map('floatval', explode(',', $coords));
            } elseif (isset($placemark->LineString)) {
                $geometryType = 'LineString';
                $coords = trim((string) $placemark->LineString->coordinates);
                $coordinates = array_map(function ($coord) {
                    return array_map('floatval', explode(',', trim($coord)));
                }, explode(' ', $coords));
            } elseif (isset($placemark->Polygon)) {
                $geometryType = 'Polygon';
                $coords = trim((string) $placemark->Polygon->outerBoundaryIs->LinearRing->coordinates);
                $coordinates = [[
                    array_map(function ($coord) {
                        return array_map('floatval', explode(',', trim($coord)));
                    }, explode(' ', $coords))
                ]];
            }
    
            $feature = [
                'type' => 'Feature',
                'properties' => [
                    'name' => (string) $placemark->name,
                    'description' => (string) $placemark->description
                ],
                'geometry' => [
                    'type' => $geometryType,
                    'coordinates' => $coordinates
                ]
            ];
    
            $geojson['features'][] = $feature;
        }
    
        return $geojson;
    }

    public function webhook_data() {
        $postData = $this->request->getJSON(true);
        $data = [
            'data' => json_encode($postData)
        ];

        $db = \Config\Database::connect();
        $db->transStart();
        try {
            // Set a shorter timeout for the transaction
            $db->query('SET SESSION wait_timeout = 5');
            $db->query('SET SESSION interactive_timeout = 5');

            $db->table('data_hooks')->insert($data);
            $insertId = $db->insertID();
            $data = json_decode($data['data'], true);
            $data['predata'] = $data;
            $data['id'] = $insertId;

            $db->transComplete();
            if ($db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            return $this->response->setJSON([
                'status_code' => 200,
                'error' => false,
                'message' => "Successfully",
                'data' => $data
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON([
                'status_code' => 500,
                'error' => true,
                'message' => "Internal Server Error: " . $e->getMessage()
            ], 500);
        }
    }

    public function hit_webhook() {

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://host.docker.internal:5005/ingest/3cY0rqGcuNHeTklU',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'[
            {
            "event": "order.incoming",
            "data": {
                "order_id": 1,
                "customer": "test customer",
                "test": "ok"
            }
        },
        {
            "event": "order.incoming",
            "data": {
                "order_id": 1,
                "customer": "test customer",
                "test": "ok"
            }
        },
        {
            "event": "order.incoming",
            "data": {
                "order_id": 1,
                "customer": "test customer",
                "test": "ok"
            }
        }
        ]',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);

        if ($response === false) {
            $error = curl_error($curl);
            curl_close($curl);
            return $this->response->setJSON([
                'status_code' => 500,
                'error' => true,
                'message' => "cURL Error: " . $error
            ], 500);
        }

        curl_close($curl);

        return $this->response->setJSON([
            'status_code' => 200,
            'error' => false,
            'message' => "Successfully",
            'data' => json_decode($response, true)
        ]);
    }

    public function test_session()
    {

        // Set session
        session()->set('username', 'NGI User');
        // Get session
        $username = session()->get('username');

        return "Session username: $username";
    }

}
