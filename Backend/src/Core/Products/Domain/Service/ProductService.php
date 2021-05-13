<?php


namespace App\Core\Products\Domain\Service;


use App\Core\Products\Application\Dto\CategoryDto;
use App\Core\Products\Application\Dto\MeasureDto;
use App\Core\Products\Application\Dto\ProductDto;
use App\Core\Products\Application\Request\ProductRequest;
use App\Core\Products\Domain\Entity\Product;
use App\Core\Products\Domain\Exception\ProductExistException;
use App\Core\Products\Domain\Exception\ProductNotFoundException;
use App\Core\Products\Domain\Repository\ProductRepositoryInterface;

class ProductService implements ProductServiceInterface
{

    protected ProductRepositoryInterface $productRepository;
    protected ResourceServiceInterface $categoryGetIdService;
    protected ResourceServiceInterface $measureGetIdService;
    protected Product $product;

    public function __construct(ProductRepositoryInterface $productRepository, ResourceServiceInterface $categoryGetIdService, ResourceServiceInterface $measureGetIdService)
    {
        $this->productRepository = $productRepository;
        $this->categoryGetIdService = $categoryGetIdService;
        $this->measureGetIdService = $measureGetIdService;
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

        $measure = new MeasureDto();
        $measure->setId('24357ac9-729b-4d78-9638-7e1f653cdf57');
        $measure->setName('UNIDAD');

        $productDto->setMeasure($measure);
        $productDto->setDescription($this->product->getDescription());
        $productDto->setSkuCode($this->product->getSkuCode());
        $productDto->setCost($this->product->getCost());
        $productDto->setFeatured($this->product->getFeatured());
        $productDto->setStock($this->product->getStock());

        $category = new CategoryDto();
        $category->setId('012b637a-702a-4643-92f1-23fc8bb11a95');
        $category->setName('CATEGORIA A');
        $productDto->setCategory($category);

        return $productDto;
    }

    public function deleteProductByUuid(string $uuid): bool
    {
        $this->findProductByUuid($uuid);
        return $this->productRepository->deleteProductById($this->product->getId());
    }

    public function findProducts(array $queries): array
    {
        return $this->productRepository->findProducts($queries);
    }

}