<?php   


    header("Access-Control-Allow-Origin: *");
    require_once "./modules/get.php";
    require_once "./modules/post.php";
    require_once "./config/database.php";

    $con = new Connection();
    $pdo = $con->connect();

    // Initialize Get and Post objects
    $get = new Get($pdo);
    $post = new Post($pdo);

    // Check if 'request' parameter is set in the request
    if(isset($_REQUEST['request'])){
         // Split the request into an array based on '/'
        $request = explode('/', $_REQUEST['request']);
    }
    else{
         // If 'request' parameter is not set, return a 404 response
        echo "Not Found";
        http_response_code(404);
    }

    // Handle requests based on HTTP method
    switch($_SERVER['REQUEST_METHOD']){
        // Handle GET requests
        case 'GET':
            switch($request[0]){
                case 'nvn':
                    echo "Add user";
                default:
                    // Return a 403 response for unsupported requests
                    echo "This is forbidden";
                    http_response_code(403);
                    break;
            }
            break;
        case 'POST':
            $data = json_decode(file_get_contents("php://input"));
            switch($request[0]){
                case 'signup':
                    echo json_encode($post->signup($data));
                    break;
                case 'login':
                    echo json_encode($post->login($data));
                    break;
                
                default:
                    echo "This is forbidden";
                    http_response_code(403);
                    break;
            }
            break;
        default:
            echo "Method not available";
            http_response_code(404);
        break;
    }

?>