<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UpdateProductQuantity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:update-quantity {id} {quantity}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is a command to update a single product\'s quantity';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            // Setup validator
            $validator = Validator::make(
                [
                    'id' => $this->argument('id'),
                    'quantity' => $this->argument('quantity'),
                ],
                [
                    'id' => [
                        'required',
                        'exists:products,id'

                    ],
                    'quantity'  => [
                        'required',
                        'integer',
                        'min:0',
                        'max:999999',
                    ]
                ]
            );

            // Display errors
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                foreach ($errors as $key => $value) {
                    $this->error($value);
                }
                return 1;
            }

            // Input
            $validated = $validator->validated();
            $id = Arr::get($validated, 'id');
            $quantity = Arr::get($validated, 'quantity');

            // Update product
            $product = Product::findOrFail($id);
            $product->quantity = $quantity;
            $product->save();

            // Show updated product
            $json = $product->toJson(JSON_PRETTY_PRINT);
            $this->info('Product Quantity updated!');
            $this->info($json);
        } catch (\Throwable $th) {
            $this->fail($th->getMessage());
        }
    }
}
