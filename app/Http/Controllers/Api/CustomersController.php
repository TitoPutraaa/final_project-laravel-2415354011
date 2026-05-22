<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index(): JsonResponse {         
        $query = Customer::query();
        
        $customers = $query->latest()->get();
        return response()->json([
            "success" => true,            
            "message" => "Customers retrieved successfully",            
            "data" => $customers,   
        ]);
    }

    public function store(Request $request): JsonResponse {
        $data = $request->validate([            
            "customer_id" => ["required", "string"],            
            "name" => ["required", "string"],            
            "email" => ["nullable", "string"],           
            "address" => ["nullable", "string"],           
            "phone" => ["nullable", "string"],            
            "status" => ["nullable", "boolean"],        
        ]);

        $customer = Customer::query()->create($data);
        return response()->json([            
            "success" => true,            
            "message" => "Service created successfully",            
            "data" => $customer,
        ], 201 );  
    }

    public function update(Request $request, int $id): JsonResponse {        
        $customer = Customer::query()->find($id);         
        if (!$customer) {            
            return response()->json([                
                "success" => false,                
                "message" => "Service not found",                
                "errors" => [],            
            ], 404 );        
        }         
        $data = $request->validate([            
            "customer_id" => ["required", "string"],            
            "name" => ["required", "string"],            
            "email" => ["nullable", "string"],           
            "address" => ["nullable", "string"],           
            "phone" => ["nullable", "string"],            
            "status" => ["nullable", "boolean"],        
        ]);
           
        $customer->update($data);         
        return response()->json([            
            "success" => true,            
            "message" => "Service updated successfully",            
            "data" => $customer,        
        ]);    
    }

        public function destroy(int $id): JsonResponse {    
        $customer = Customer::query()->find($id);         
        if (!$customer) {            
            return response()->json([                
                "success" => false,                
                "message" => "customer $customer not found",                
                "errors" => [],            
            ], 404 );        
        }         
        if ($customer->subscriptions()->exists()) {            
            return response()->json([                
                "success" => false,                
                "message" => "customer $customer cannot be deleted because it has subscriptions",                
                "errors" => [],            
            ], 422 );        
        }         
        $customer->delete($id);
        return response()->json([            
            "success" => true,            
            "message" => "customer$customer deleted successfully",            
            "data" => null,        
        ]);    
    }

        public function activate(int $id): JsonResponse {        
        $customer = Customer::query()->find($id);         
        if (!$customer) {            
            return response()->json([                
                "success" => false,                
                "message" => "customer $customer not found",                
                "errors" => [],            
            ], 404 );       
        }         
        $customer->update(["status" => true]);         
        return response()->json([            
            "success" => true,            
            "message" => "custo $customer activated successfully",            
            "data" => $customer,        
        ]);
    }

        public function deactivate(int $id): JsonResponse {        
        $customer = Customer::query()->find($id);         
        if (!$customer) {            
            return response()->json([                
                "success" => false,                
                "message" => "customer $customer not found",                
                "errors" => [],            
            ], 404 );        
        }         
        $customer->update(["status" => false]);         
        return response()->json([            
            "success" => true,            
            "message" => "cusomer $customer deactivated successfully",            
            "data" => $customer,        
        ]);    
    } 
}