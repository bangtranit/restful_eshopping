<?php  
namespace App\Traits;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponser
{
	private function successResponse($data, $code)
	{
		return response()->json($data, $code);
	}

	protected function errorResponse($message, $code)
	{
		return response()->json(['error' => $message, 'code' => $code], $code);
	}

	protected function showAll(Collection $collection, $code = 200)
	{
		if ($collection->isEmpty()) {
			return $this->successResponse(['data' => $collection], $code);
		}
		$transformer = $collection->first()->transformer;
		$collection = $this->transformData($collection, $transformer);
		return $this->successResponse($collection, $code);
	}

	protected function showOne(Model $instance, $code = 200)
	{
		if ($instance->isEmpty()) {
			return $this->successResponse($instance, $code);
		}
		$transformer = $instance->transformer;
		$instance = $this->transformData($instance, $transformer);
		return $this->successResponse($instance, $code);
	}

	protected function showDirtyResponse(){
		return $this->errorResponse('you need to specify any different value to update', 422);
	}  

	protected function showMessageSuccess($message){
		return response()->json(['message' => $message, 'code' => 200], 200); 
	}

	protected function showMessage($message, $code = 200){
		return $this->successResponse(['data' => $message], $code);
	}

	protected function transformData($data, $transformer){
		$transformation = fractal($data, new $transformer);
		return $transformation->toArray();
	}
	
}