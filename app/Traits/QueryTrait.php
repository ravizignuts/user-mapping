<?php
    namespace App\Traits;
    use App\Models\Module;

    trait QueryTrait{
        public function getModule($id){
            $module = Module::findOrFail($id);
            return response()->json([
                'message' => 'Module  details',
                'module'  => $module
            ]);
        }
    }
?>
