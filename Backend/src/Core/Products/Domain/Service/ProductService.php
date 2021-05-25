<?php


namespace App\Core\Products\Domain\Service;


use App\Core\Categories\Domain\CategoryServiceInterface;
use App\Core\Measures\Domain\MeasureServiceInterface;
//use App\Core\Products\Application\Dto\CategoryDto;
//use App\Core\Products\Application\Dto\MeasureDto;
use App\Core\Products\Application\Dto\ProductDto;
use App\Core\Products\Application\Request\ProductRequest;
use App\Core\Products\Domain\Entity\Product;
use App\Core\Products\Domain\Entity\ProductPaginateParams;
use App\Core\Products\Domain\Entity\ProductPaginateResponse;
use App\Core\Products\Domain\Exception\ProductExistException;
use App\Core\Products\Domain\Exception\ProductNotFoundException;
use App\Core\Products\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Helpers\PaginateParams;

class ProductService implements ProductServiceInterface
{

    protected ProductRepositoryInterface $productRepository;
    protected CategoryServiceInterface $categoryService;
    protected MeasureServiceInterface $measureService;

    protected ResourceServiceInterface $categoryGetIdService;
    protected ResourceServiceInterface $measureGetIdService;
    protected Product $product;


    public function __construct(ProductRepositoryInterface $productRepository,
                                ResourceServiceInterface $categoryGetIdService,
                                ResourceServiceInterface $measureGetIdService,
                                CategoryServiceInterface $categoryService,
                                MeasureServiceInterface $measureService
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryGetIdService = $categoryGetIdService;
        $this->measureGetIdService = $measureGetIdService;
        $this->categoryService = $categoryService;
        $this->measureService = $measureService;
        $this->product = new Product();
    }


    public function addProduct(ProductRequest $productRequest): bool
    {

        $categoryId = $this->categoryGetIdService->getIdByUuid($productRequest->getCategoryId());
        $measureId = $this->measureGetIdService->getIdByUuid($productRequest->getMeasureId());

        $toEntity = $this->product->transformRequestToEntity($productRequest);
        $toEntity->setCategoryId($categoryId);
        $toEntity->setMeasureId($measureId);

        return $this->productRepository->addProduct($toEntity);
    }

    public function updateProductByUuid(string $uuid, ProductRequest $productRequest): bool
    {
        $this->findProductByUuid($uuid);
        $categoryId = $this->categoryGetIdService->getIdByUuid($productRequest->getCategoryId());
        $measureId = $this->measureGetIdService->getIdByUuid($productRequest->getMeasureId());

        $toEntity = $this->product->transformRequestToEntity($productRequest);
        $toEntity->setCategoryId($categoryId);
        $toEntity->setMeasureId($measureId);
        $toEntity->setUuid($uuid);

        return $this->productRepository->editProductById($this->product->getId(), $toEntity);
    }

    public function findProductByUuid(string $uuid): ProductDto
    {

        $product = $this->productRepository->findProductByUuid($uuid);

        $this->product = $product;

        $productDto = new ProductDto();
        $productDto->setId($this->product->getUuid());
        $productDto->setImage($this->product->getImage());
        $productDto->setName($this->product->getName());
        $productDto->setPrice($this->product->getPrice());
        $productDto->setPromotionPrice($this->product->getPromotionPrice());


        $measure = $this->measureService->findMeasureById($this->product->getMeasureId());
        $productDto->setMeasure($measure);

        $productDto->setDescription($this->product->getDescription());
        $productDto->setSkuCode($this->product->getSkuCode());
        $productDto->setCost($this->product->getCost());
        $productDto->setFeatured($this->product->getFeatured());
        $productDto->setStock($this->product->getStock());

        $category = $this->categoryService->findCategoryById($this->product->getCategoryId());
        $productDto->setCategory($category);

        return $productDto;
    }

    public function deleteProductByUuid(string $uuid): bool
    {
        $this->findProductByUuid($uuid);
        return $this->productRepository->deleteProductById($this->product->getId());
    }

    public function findProducts(ProductPaginateParams $queries): ProductPaginateResponse
    {
        $lstProducts = [];
        $lst = $this->productRepository->findProducts($queries);
        foreach ($lst->getRows() as $item) {
            $lstProducts[] = $this->product->transformEntityToDtoPaginate($item);
        }
        $lst->setRows(array_values($lstProducts));
        return $lst;
    }

    public function findProductSelectIdByUid(string $uuid): Product
    {
        return $this->productRepository->findProductSelectIdByUid($uuid);
    }
}