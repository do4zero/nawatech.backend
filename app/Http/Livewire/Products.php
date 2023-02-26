<?php

namespace App\Http\Livewire;

use App\Services\Products\API\GetShopInformationService;
use App\Services\Products\DeleteProductService;
use App\Services\Products\GetAllProductsService;
use App\Services\Products\GetOneProductService;
use App\Services\Products\StoreProductService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Products extends Component
{
    use WithPagination;
    use WithFileUploads;

    // Model
    public $name, $description, $price, $stok, $image, $product_id;
    public $isOpen = 0;
    public $searchTerm = '';

    /**
     * --------------------------
     * Validation
     * --------------------------
     */
    protected $rules = [
        'name' => 'required',
        'price' => 'required|integer',
        'stok' => 'required|integer',
    ];

    protected $messages = [
        'name.required' => 'Product Name cannot be empty.',
        'price.required' => 'Price cannot be empty.',
        'price.integer' => 'Price format is not valid, must be integer value.',
        'stok.required' => 'Stok cannot be empty.',
        'stok.integer' => 'Stok format is not valid.',
    ];


    /**
     * --------------------------
     * Render Image
     * --------------------------
     */
    public function render(GetAllProductsService $allProducts)
    {
        $shop = app('App\Services\Shop\GetShopInformationService')->getInfoByAuth()['data'];
        $params = [
            'search' => $this->searchTerm,
            'shop_code' => $shop['shop']['code'],
            'user_id' => $shop['seller']['id'],
        ];

        $bagikanLink =  env('FE_BASE_PATH','http://localhost:8081/').'toko/'.$shop['shop']['code'];

        return view('livewire.products',[
            'products' => $allProducts->display($params),
            'bagikanLink' => $bagikanLink
        ]);
    }

    /**
     * --------------------------
     * Call Create Product Modal
     * --------------------------
     */
    public function create()
    {
        $this->bindFields();
        $this->openModal();
    }

    /**
     * --------------------------
     * For Open Modal
     * --------------------------
     */
    public function openModal()
    {
        $this->isOpen = true;
    }

    /**
     * --------------------------
     * For Close Modal
     * --------------------------
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }

    /**
     * --------------------------
     * Edit Product
     * --------------------------
     */
    public function edit($id, GetOneProductService $product)
    {
        $product = $product->display($id);
        $this->bindFields($product);
        $this->openModal();
    }
    /**
     * --------------------------
     * Save Product
     * --------------------------
     */
    public function save(StoreProductService $product)
    {
        $this->validate();
        
        $shop = app('App\Services\Shop\GetShopInformationService')->getInfoByAuth()['data'];
        $product = $product->save([
                                'name' => $this->name,
                                'description' => $this->description,
                                'price' => $this->price,
                                'stok' => $this->stok,
                                'image' => $this->image,
                                'shop_code' => $shop['shop']['code'],
                                'user_id' => $shop['seller']['id'],
                            ],
                            $this->product_id
                        );

        session()->flash('message', $product['message']);

        $this->closeModal();
        $this->bindFields();
    }

    /**
     * --------------------------
     * Delete Product
     * --------------------------
     */
    public function delete($id, DeleteProductService $delete)
    {
        $product = $delete->execute($id);
        session()->flash('message', $product['message']);
    }

    /**
     * --------------------------
     * Bind Fields
     * --------------------------
     */
    private function bindFields($data = array())
    {
        $this->product_id = !empty($data['id']) ? $data['id'] : '';
        $this->name = !empty($data['name']) ? $data['name'] : '';
        $this->description = !empty($data['description']) ? $data['description'] : '';
        $this->price = !empty($data['price']) ? (int) $data['price'] : '';
        $this->stok = !empty($data['stok']) ? $data['stok'] : '';
        $this->image = !empty($data['image']) ? $data['image'] : '';
    }
}
