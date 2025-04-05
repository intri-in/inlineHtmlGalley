{**
 * templates/frontend/pages/article.tpl
 *
 * Copyright (c) University of Pittsburgh
 * Copyright (c) 2014-2019 Simon Fraser University
 * Copyright (c) 2003-2019 John Willinsky
 * Distributed under the GNU GPL v2 or later. For full terms see the file docs/COPYING.
 *
 * @brief Display the page to view an article with all of it's details.
 *
 * @uses $article Article This article
 * @uses $issue Issue The issue this article is assigned to
 * @uses $section Section The journal section this article is assigned to
 * @uses $journal Journal The journal currently being viewed.
 * @uses $primaryGalleys array List of article galleys that are not supplementary or dependent
 * @uses $supplementaryGalleys array List of article galleys that are supplementary
 * @uses $inlineHtmlGalley string The HTML content of the Article Galley
 *}
{include file="frontend/components/header.tpl" pageTitleTranslated=$article->getLocalizedTitle()|escape}
	<a name="top"></a>
<div>
	{if $section}
		{include file="frontend/components/breadcrumbs_article.tpl" currentTitle=$section->getLocalizedTitle()}
	{else}
		{include file="frontend/components/breadcrumbs_article.tpl" currentTitleKey="article.article"}
	{/if}
		{include file="frontend/objects/article_details.tpl" currentTitle=$section->getLocalizedTitle()}
	{* Anchor for "Back to Top" button *}
	{if $hasAccess}
                <hr class="dashed">

     		<div class="panel articleText panel-default issue">
		<div class="panel-heading">
			<h2 class="panel-title">
				Article Text
			</h2>
		</div>
	
		{* Show article inline *}
		<div class="inline_html_galley">
		{$inlineHtmlGalley}
		</div>
	        <br />
		<div class="reader-options">
			<a class="back-to-top" href="#top">
				<span class="arrow-gylph">↑</span>
				{translate key="plugins.generic.inlineHtmlGalley.backToTop"}
			</a>
		</div>
		</div>

                <br />
       {/if}

	{call_hook name="Templates::Article::Footer::PageFooter"}

</div><!-- .page -->

{include file="frontend/components/footer.tpl"}
