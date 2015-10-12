<?php
/**
 * Created by PhpStorm.
 * User: tylercazier
 * Date: 10/8/15
 * Time: 6:32 PM
 */

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

$app = new Application();
$app['debug'] = true;

$teachers = [
    '0001' => [
        'name' => 'Tom Johnson',
        'hireDate' => '10/15/15',
        'course' => 'CS 4500'
    ],
    '0002' => [
        'name' => 'John John',
        'hireDate' => '12/5/14',
        'course' => 'MATH 1010'
    ],
    '0003' => [
        'name' => 'Terry Rodgers',
        'hireDate' => '05/12/80',
        'course' => 'ENG 3430'
    ],
    '0004' => [
        'name' => 'Samuel Cooley',
        'hireDate' => '1/2/2013',
        'course' => 'MATH 2130'
    ]
];

$students = [
    '1001' => [
        'name' => 'Jack Haslam',
        'year' => 'Junior',
        'course' => 'ENG 3430',
        'grade' => 'A'
    ],
    '1002' => [
        'name' => 'Jim Jones',
        'year' => 'Sophomore',
        'course' => 'MATH 1010',
        'grade' => 'A'
    ],
    '1003' => [
        'name' => 'Adam Smith',
        'year' => 'Sophomore',
        'course' => 'MATH 1010',
        'grade' => 'B'
    ],
    '1004' => [
        'name' => 'Albert Snow',
        'year' => 'Junior',
        'course' => 'CS 4500',
        'grade' => 'D'
    ]
];

$users = [
    '2001' => [
        'name' => 'Tom Johnson',
        'username' => 'tom.johnson',
        'accessLevel' => 'admin'
    ],
    '2002' => [
        'name' => 'John John',
        'username' => 'john.john',
        'accessLevel' => 'admin'
    ],
    '2003' => [
        'name' => 'Terry Rodgers',
        'username' => 'terry.rodgers',
        'accessLevel' => 'admin'
    ],
    '2004' => [
        'name' => 'Samuel Cooley',
        'username' => 'samuel.cooley',
        'accessLevel' => 'admin'
    ],
    '2005' => [
        'name' => 'Jack Haslam',
        'username' => 'jack.haslam',
        'accessLevel' => 'user'
    ],
    '2006' => [
        'name' => 'Jim Jones',
        'username' => 'jim.jones',
        'accessLevel' => 'user'
    ],
    '2007' => [
        'name' => 'Adam Smith',
        'username' => 'adam.smith',
        'accessLevel' => 'user'
    ],
    '2008' => [
        'name' => 'Albert Snow',
        'username' => 'albert.snow',
        'accessLevel' => 'user'
    ]
];

// POST

$app->post('/teachers',function(Application $app, Request $request) use (&$teachers){
    $id=uniqid();
    $teachers[$id] = json_decode($request->getContent());
    $jsons = json_encode($teachers);
    $response =  new Response($jsons,200);
    $response->headers->set('Content-Type','application/json');
    $response->headers->set('Content-Length',strlen($jsons));
    return $response;
});

$app->post('/students',function(Application $app, Request $request) use (&$students){
    $id=uniqid();
    $students[$id] = json_decode($request->getContent());
    $jsons = json_encode($students);
    $response =  new Response($jsons,200);
    $response->headers->set('Content-Type','application/json');
    $response->headers->set('Content-Length',strlen($jsons));
    return $response;
});

$app->post('/users',function(Application $app, Request $request) use (&$users){
    $id=uniqid();
    $users[$id] = json_decode($request->getContent());
    $jsons = json_encode($users);
    $response =  new Response($jsons,200);
    $response->headers->set('Content-Type','application/json');
    $response->headers->set('Content-Length',strlen($jsons));
    return $response;
});

// GET ALL

$app->get('/', function() {
    return new Response('<h1>Class Room API POC</h1>', 200);
});

$app->get('/teachers',function() use ($teachers){
    $jsons = json_encode($teachers);
    $response =  new Response($jsons,200);
    $response->headers->set('Content-Type','application/json');
    $response->headers->set('Content-Length',strlen($jsons));
    return $response;
});

$app->get('/students',function() use ($students){
    $jsons = json_encode($students);
    $response =  new Response($jsons,200);
    $response->headers->set('Content-Type','application/json');
    $response->headers->set('Content-Length',strlen($jsons));
    return $response;
});

$app->get('/users',function() use ($users){
    $jsons = json_encode($users);
    $response =  new Response($jsons,200);
    $response->headers->set('Content-Type','application/json');
    $response->headers->set('Content-Length',strlen($jsons));
    return $response;
});


// GET ID

$app->get('/teachers/{teacherId}',function(Application $app, $teacherId) use ($teachers){
    if(!isset($teachers[$teacherId])) // Check to see if ID is in the system.
    {
        $app->abort(404,"$teacherId is not a valid teacher id.");
    }
    $jsons = json_encode($teachers[$teacherId]);
    $response =  new Response($jsons,200);
    $response->headers->set('Content-Type','application/json');
    $response->headers->set('Content-Length',strlen($jsons));
    return $response;
});

$app->get('/students/{studentId}',function(Application $app, $studentId) use ($students){
    if(!isset($students[$studentId]))
    {
        $app->abort(404,"$studentId is not a valid student id.");
    }
    $jsons = json_encode($students[$studentId]);
    $response =  new Response($jsons,200);
    $response->headers->set('Content-Type','application/json');
    $response->headers->set('Content-Length',strlen($jsons));
    return $response;
});

$app->get('/users/{userId}',function(Application $app, $userId) use ($users){
    if(!isset($users[$userId]))
    {
        $app->abort(404,"$userId is not a valid user id.");
    }
    $jsons = json_encode($users[$userId]);
    $response =  new Response($jsons,200);
    $response->headers->set('Content-Type','application/json');
    $response->headers->set('Content-Length',strlen($jsons));
    return $response;
});

// PUT

$app->put('/teachers/{teacherId}',function(Application $app, Request $request, $teacherId) use (&$teachers){
    if(!isset($teachers[$teacherId]))
    {
        $app->abort(404,"item with ID $teacherId does not exist.");
    }
    $teachers[$teacherId]=json_decode($request->getContent());
    $jsons = json_encode($teachers);
    $response =  new Response($jsons,200);
    $response->headers->set('Content-Type','application/json');
    $response->headers->set('Content-Length',strlen($jsons));
    return $response;
});

$app->put('/students/{studentId}',function(Application $app, Request $request, $studentId) use (&$students){
    if(!isset($students[$studentId]))
    {
        $app->abort(404,"item with ID $studentId does not exist.");
    }
    $students[$studentId]=json_decode($request->getContent());
    $jsons = json_encode($students);
    $response =  new Response($jsons,200);
    $response->headers->set('Content-Type','application/json');
    $response->headers->set('Content-Length',strlen($jsons));
    return $response;
});


$app->put('/users/{userId}',function(Application $app, Request $request, $userId) use (&$users){
    if(!isset($users[$userId]))
    {
        $app->abort(404,"item with ID $userId does not exist.");
    }
    $users[$userId]=json_decode($request->getContent());
    $jsons = json_encode($users);
    $response =  new Response($jsons,200);
    $response->headers->set('Content-Type','application/json');
    $response->headers->set('Content-Length',strlen($jsons));
    return $response;
});

// DELETE

$app->delete('/teachers/{teacherId}',function(Application $app, $teacherId) use (&$teachers){
    if(!isset($teachers[$teacherId]))
    {
        $app->abort(404,"Note with ID $teacherId does not exist.");
    }
    unset($teachers[$teacherId]);
    $response = new Response("Teacher deleted.",204);
    return $response;
});

$app->delete('/students/{studentId}',function(Application $app, $studentId) use (&$students){
    if(!isset($students[$studentId]))
    {
        $app->abort(404,"Note with ID $studentId does not exist.");
    }
    unset($students[$studentId]);
    $response = new Response("Student deleted.",204);
    return $response;
});

$app->delete('/users/{userId}',function(Application $app, $userId) use (&$users){
    if(!isset($users[$userId]))
    {
        $app->abort(404,"Note with ID $userd does not exist.");
    }
    unset($users[$userId]);
    $response = new Response("User deleted.",204);
    return $response;
});

$app->run();