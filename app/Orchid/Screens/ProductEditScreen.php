<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductEditScreen extends Screen
{

    protected $product;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Product $product): iterable
    {
        return [
            $this->product => $product
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Edit Product';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Edit Product')
                ->icon('plus')
                ->method('editProduct')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return Layout[]|string[]
     */
    public function layout(): array
    {
        $product = $this->product;
        return [
            Layout::rows([
                Input::make('product.name')
                    ->title('Product Name')
                    ->placeholder($product->name),

                Input::make('product.price')
                    ->title('Product Price')
                    ->placeholder($product->price),

                Input::make('product.provider')
                    ->title('Product Provider')
                    ->placeholder($product->provider),

                Input::make('product.description')
                    ->title('Product Description')
                    ->placeholder($product->description),

                Input::make('product.url')
                    ->title('Product Image URL')
                    ->placeholder($product->url)
            ])
        ];
    }



    public function Product(Product $product, Request $request){
        $product->fill($request->get('product'))->save();

        return redirect()->route('platform.products.list');
    }
}
