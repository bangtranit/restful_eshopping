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
		return $this->successResponse(['data' => $collection], $code);
	}

	protected function showOne(Model $model, $code = 200)
	{
		return $this->successResponse(['data' => $model], $code);
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
	
}