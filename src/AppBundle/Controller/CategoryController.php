<?php
namespace AppBundle\Controller;

use DateTime;
use FOS\RestBundle\View\View;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Service\CategoryService;
use AppBundle\Structure\BaseController;
use AppBundle\Form\Type\CategoryType;
use AppBundle\Entity\Category;

class CategoryController extends BaseController
{
    private $categoryService;
    
    private function CategoryService()
    {
        if(is_null($this->categoryService))
        {
            $this->getContext();
            $this->categoryService = new CategoryService($this->unitOfWork);
        }
        return $this->categoryService;
    }

    /**
     * @Rest\View(serializerGroups={"category"})
     * @Rest\Get("categories")
     */
    public function getCategoriesAction()
    {
        $categories = $this->CategoryService()->getAll();
        return $categories;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/category/{id}")
     * @param Request $request
     * @return static
     */
    public function getCategoryAction(Request $request)
    {
        $result = $this->CategoryService()->getById(intval($request->get('id')));
        if (empty($result)) {
            return $this->categoryNotFound();
        }
        return $result;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/category")
     * @param Request $request
     * @return Category|FormInterface
     */
    public function postCategoryAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->submit($request->request->all());

        if ($form->isValid())
        {
            $category = $this->CategoryService()->Add($category);
            return $category;
        }
        else return $form;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/category/{id}")
     * @param Request $request
     */
    public function removeCategoryAction(Request $request)
    {
        $category = $this->CategoryService()->getById(intval($request->get('id')));
        if ($category) {
            $this->CategoryService()->Delete($category);
        }
    }

    /**
     * @Rest\View()
     * @Rest\Put("/category/{id}")
     * @param Request $request
     * @return FormInterface|Category
     */
    public function updateCategoryAction(Request $request)
    {
        return $this->updateCategory($request, true);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/category/{id}")
     * @param Request $request
     * @return FormInterface|Category
     */
    public function patchCategoryAction(Request $request)
    {
        return $this->updateCategory($request, false);
    }

    private function updateCategory(Request $request, $clearMissing)
    {
        $category = $this->CategoryService()->getById(intval($request->get('id')));

        if (empty($category)) {
            return $this->categoryNotFound();
        }

        $form = $this->createForm(CategoryType::class, $category);

        // Le paramètre false dit à Symfony de garder les valeurs dans notre entité si l'utilisateur n'en fournit pas une dans sa requête
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid())
        {
            $category = $this->CategoryService()->Update($category );
            return $category;
        }
        else return $form;
    }
    
    private function categoryNotFound()
    {
        return View::create(['message' => 'Category not found'], Response::HTTP_NOT_FOUND);
    }
}