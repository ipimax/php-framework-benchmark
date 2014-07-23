<?php

namespace ruxon\modules\Ruxon\components\Pager\classes;

class PagerComponent extends \Component
{
    protected $sModuleAlias = 'Ruxon';
    protected $sComponentAlias = 'Pager';

    public function run()
    {
        $this->start();

		$aResult = array();  
        $aResult['Pages'] = array();
        $aResult['Title'] = $this->getComponentRequest()->getTitle();
        $pages = $this->getComponentRequest()->getPages();

        if ($pages->getPageCount() > 1)
        {
            /*$aResult['Pages'][] = array(
                'title' => 'Первая',
                'url' => $this->getPageUrl(1),
                'active' => $pages->getCurrentPage() == 1 ? true : false
            );*/

            $aResult['Pages'][] = array(
                'title' => '&laquo;',
                'url' => $this->getPageUrl($pages->getCurrentPage() - 1),
                'active' => $pages->getCurrentPage() == 1 ? true : false
            );
            
            if ($pages->getPageCount() > 6)
            {
                $nStartPage = $pages->getCurrentPage() - 3;
                if ($nStartPage <= 0) $nStartPage = 1;
                
                for($i = $nStartPage; $i <= $nStartPage + 3; $i++)
                {
                    $curr_page = array();

                    if ($pages->getCurrentPage() == $i)
                    {
                        $curr_page = array(
                            'active' => true,
                            'title' => $i
                        );
                    } else {
                        $curr_page = array(
                            'active' => false,
                            'title' => $i
                        );
                    }

                    $curr_page['url'] = $this->getPageUrl($i);

                    $aResult['Pages'][] = $curr_page;
                    unset($curr_page);
                }
                
                if ($pages->getCurrentPage() > 3) {
                    $nEndPage = $pages->getCurrentPage() + 3;
                    if ($nEndPage > $pages->getPageCount()) $nEndPage = $pages->getPageCount();

                    for($i = $pages->getCurrentPage() + 1; $i <= $nEndPage; $i++)
                    {
                        $curr_page = array();

                        if ($pages->getCurrentPage() == $i)
                        {
                            $curr_page = array(
                                'active' => true,
                                'title' => $i
                            );
                        } else {
                            $curr_page = array(
                                'active' => false,
                                'title' => $i
                            );
                        }

                        $curr_page['url'] = $this->getPageUrl($i);

                        $aResult['Pages'][] = $curr_page;
                        unset($curr_page);
                    }
                }
            } 
            else
            {
                for($i = 1; $i <= $pages->getPageCount(); $i++)
                {
                    $curr_page = array();

                    if ($pages->getCurrentPage() == $i)
                    {
                        $curr_page = array(
                            'active' => true,
                            'title' => $i
                        );
                    } else {
                        $curr_page = array(
                            'active' => false,
                            'title' => $i
                        );
                    }

                    $curr_page['url'] = $this->getPageUrl($i);

                    $aResult['Pages'][] = $curr_page;
                    unset($curr_page);
                }
            }
            
            $aResult['Pages'][] = array(
                'title' => '&raquo;',
                'url' => $this->getPageUrl($pages->getCurrentPage() + 1),
                'active' => $pages->getCurrentPage() >= $pages->getPageCount() ? true : false
            );

            /*$aResult['Pages'][] = array(
                'title' => 'Последняя',
                'url' => $this->getPageUrl($pages->getPageCount()),
                'active' => $pages->getCurrentPage() == $pages->getPageCount() ? true : false
            );*/
        }
        
        $this->end($aResult, true);
    }
    
    public function getPageUrl($page)
    {
        $params = $this->getComponentRequest()->getAnotherParams();
        $sort_field = isset($_GET['sort_field']) ? $_GET['sort_field']: '';
        $sort_direction = isset($_GET['sort_direction']) ? $_GET['sort_direction'] : '';
        
        
        
        if ($page < 1) $page = 1;
        
        if ($page != 1)
        {
            $params['page'] = $page;
        } 
        
        if ($sort_field && $sort_direction) {
            $params['sort_field'] = $sort_field;
            $params['sort_direction'] = $sort_direction;
        }


        
        $res = \Toolkit::getInstance()->request->getCleanUrl();

        return \Toolkit::i()->urlManager->createUrl($res, $params);
    }
}