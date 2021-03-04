<?php

namespace Kitzberger\DragonDrop\ViewHelpers\Be;

class CutRecordViewHelper extends AbstractViewHelper
{
    /**
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();

        $this->registerArgument(
            'uid',
            'integer',
            null,
            true
        );
    }

    /**
     * Render an edit link for a given record.
     *
     * @return string the edit link
     */
    public function render()
    {
        $pageRenderer = $this->getPageRenderer();
        $pageRenderer->loadRequireJsModule('TYPO3/CMS/DragonDrop/Maester');

        // prepare parameters
        $uid = $this->arguments['uid'];

        $pasteItem = $this->getElementFromClipboard();
        if ($uid == $pasteItem) {
            $link = sprintf(
                '<a class="btn btn-default btn-sm ext-dragon-drop-release"
                   title="%s"
                   data-table="tt_content"
                   data-uid="%d">
                   %s
                </a>',
                $GLOBALS['LANG']->sL('LLL:EXT:lang/Resources/Private/Language/locallang_core.xlf:labels.clipboard.clear_clipboard'),
                $uid,
                $this->getText('apps-pagetree-drag-place-denied')
            );
        } else {
            $link = sprintf(
                '<a class="btn btn-default btn-sm ext-dragon-drop-cutter"
                   title="%s"
                   data-table="tt_content"
                   data-uid="%d">
                   %s
                </a>',
                $GLOBALS['LANG']->sL('LLL:EXT:lang/Resources/Private/Language/locallang_core.xlf:cm.cut'),
                $uid,
                $this->getText('actions-edit-cut')
            );
        }

        return $link;
    }
}
