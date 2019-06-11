<form action="" method="post" class="defaultForm form-horizontal">
	<div class="panel">
		<div class="panel-heading">{l s='Settings' mod='cookieconsent'}</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Policy link' mod='cookieconsent'}</label>
			<div class="col-lg-6">
				<input type="text" name="policy_link" value="{$policy_link}">
			</div>
		</div>
		<input type="submit" class="btn btn-default" name="submitUpdate" value="{l s='Save' mod='cookieconsent'}"/>		
	</div>
</form>