<label class="control-label"{if not $isViewForm} for="{$editorId}"{/if} data-column="{$ColumnViewData.FieldName}">
	{$Captions->GetMessageString($Col->getCaption())}:

    {if not $isViewForm}
		{if isset($Help)}<button type="button" class="btn_whatisthis" data-toggle="modal" data-target="#{$Help}" title="{$Captions->GetMessageString('WhatIsThis')}"><i class="icon-question"></i></button>{/if}
        <span class="required-mark">{if not $ColumnViewData.Required}&nbsp;&nbsp;{else} *{/if}</span>
        {include file="edit_field_options.tpl" Column=$ColumnViewData}
    {/if}
</label>

<div class="modal fade" id="{$Help}" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<span style="font-size:16pt;">{$Captions->GetMessageString('WhatIsThis')}</span>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<p></p>
				<div class="text_whatisthis">

Porque nós o usamos?
É um fato conhecido de todos que um leitor se distrairá com o conteúdo de texto legível de uma página quando estiver examinando sua diagramação. A vantagem de usar Lorem Ipsum é que ele tem uma distribuição normal de letras, ao contrário de "Conteúdo aqui, conteúdo aqui", fazendo com que ele tenha uma aparência similar a de um texto legível. Muitos softwares de publicação e editores de páginas na internet agora usam Lorem Ipsum como texto-modelo padrão, e uma rápida busca por 'lorem ipsum' mostra vários websites ainda em sua fase de construção. Várias versões novas surgiram ao longo dos anos, eventualmente por acidente, e às vezes de propósito (injetando humor, e coisas do gênero).

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-cancel" data-dismiss="modal">{$Captions->GetMessageString('Close')}</button>
			</div>
		</div>
	</div>
</div>
