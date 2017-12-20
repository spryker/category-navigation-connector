<?php

namespace Spryker\Zed\CategoryNavigationConnector\Business\Model;

use Spryker\Zed\CategoryNavigationConnector\Dependency\Facade\CategoryNavigationConnectorToNavigationFacadeInterface;

class NavigationNodesIsActiveUpdater implements NavigationNodesIsActiveUpdaterInterface
{
    /**
     * @var \Spryker\Zed\CategoryNavigationConnector\Dependency\Facade\CategoryNavigationConnectorToNavigationFacadeInterface
     */
    protected $navigationFacade;

    /**
     * @var \Spryker\Zed\CategoryNavigationConnector\Business\Model\NavigationNodeReaderInterface
     */
    protected $navigationNodeReader;

    /**
     * @param \Spryker\Zed\CategoryNavigationConnector\Dependency\Facade\CategoryNavigationConnectorToNavigationFacadeInterface $navigationFacade
     * @param \Spryker\Zed\CategoryNavigationConnector\Business\Model\NavigationNodeReaderInterface $navigationNodeReader
     */
    public function __construct(CategoryNavigationConnectorToNavigationFacadeInterface $navigationFacade, NavigationNodeReaderInterface $navigationNodeReader)
    {
        $this->navigationFacade = $navigationFacade;
        $this->navigationNodeReader = $navigationNodeReader;
    }

    /**
     * @param int $idCategoryNode
     * @param bool $isActive
     */
    public function updateCategoryNodeNavigationNodes($idCategoryNode, $isActive)
    {
        $navigationNodes = $this->navigationNodeReader->getNavigationNodesFromCategoryNodeId($idCategoryNode);
        foreach($navigationNodes as $navigationNode) {
            $navigationNode->setIsActive($isActive);
            $this->navigationFacade->updateNavigationNode($navigationNode);
        }
    }
}
