<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * @return array
     */
    public function index() {
        $todos = Todo::all();

        if ($todos->isEmpty()) {
            $response = [
                'data' => null,
                'status' => 422,
                'success' => false
            ];
        } else {
            $response = [
                'data' => $todos,
                'status' => 200,
                'success' => true
            ];
        }

        return $response;
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function create(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'nullable',
                'image' => 'nullable|image'
            ]);


            if ($validator->fails()) {
                $response = [
                    'data' => null,
                    'status' => 212,
                    'success' => false,
                    'errors' => $validator->errors(),
                ];
            } else {
                $store = '';
                if (!empty($request->file('image'))) {
                    $image = $request->file('image');
                    $store = Storage::disk('public')->put('images', $image);

                }

                $todo = Todo::create([
                    'title' => $request->get('title'),
                    'description' => $request->get('description') ?? '',
                    'image_name' => basename($store) ?? ''
                ]);

                $response = [
                    'data' => $todo,
                    'status' => 200,
                    'success' => true
                ];

            }

            return json_encode($response);

        } catch (\Exception $exception) {
            return json_encode([
                'message' => 'Er is wat misgegaan, probeer het later opnieuw',
                'type' => 'error',
                'success' => false,
            ]);
        }




    }

    /**
     * @param int $id
     * @return false|\Illuminate\Http\JsonResponse|string
     */
    public function destroy(int $id) {
        try {

            $todo = Todo::find($id);

            if (!$todo) {
                $response = [
                    'message' => 'Verwijderen mislukt, probeer het later opnieuw.',
                    'success' => false
                ];
            } else {
                $todo->delete();
                $response = [
                    'message' => 'Verwijderen gelukt!',
                    'success' => true
                ];
            }

            return response()->json($response);
        } catch (\Exception $exception) {
            return json_encode([
                'message' => 'Er is wat misgegaan, probeer het later opnieuw',
                'type' => 'error',
                'success' => false,
            ]);
        }
    }

    /**
     * @param int $id
     */
    public function toggleTodo(int $id) {
        try {
            $todo = Todo::find($id);
            $todo->is_done = !$todo->is_done;
            $todo->save();

            return json_encode($todo);
        } catch (\Exception $exception) {
            return json_encode([
                'message' => 'Er is wat misgegaan, probeer het later opnieuw',
                'type' => 'error',
                'success' => false,
            ]);
        }
    }
}
