{capture assign=NavbarContent}
    {include file='custom_templates/custom_menu.tpl'}
    {$NavbarContent}
{/capture}

{capture assign=ContentBlock}
    {$ContentBlock}
    {$pageDemoVideoLink}
    {$runDemoTour}
    <div class="modal fade" id="demo-about" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">About this demo</h4>
            </div>
            <div class="modal-body">
                <p>This demo application contains 100+ pages and illustrates most of features provided by PHP Generator. Hope it will help you to create even more powerful websites for your users.</p>
                <p>You can <a href="http://www.sqlmaestro.com/products/mysql/phpgenerator/download/feature_demo_project/" target="_blank">download the demo project</a> from our website and run the demo on your webserver as described in readme.txt.</p>
            </div>
            <div class="modal-footer">
                <a href="http://www.sqlmaestro.com/products/mysql/phpgenerator/download/" class="btn btn-primary" target="_blank">Download PHP Generator Free Trial</a>
                <button type="button" class="btn btn-cancel" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{/capture}

{capture assign=ContentBlockClass}{$ContentBlockClass} col-md-12 {$pageContentBlockClass}{/capture}

{include file='common/layout.tpl'}
