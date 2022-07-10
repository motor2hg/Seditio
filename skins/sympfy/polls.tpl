<!-- BEGIN: MAIN -->

<main id="system">
	
	<div class="container">
	
	{POLLS_BREADCRUMBS}
	
	<!-- BEGIN: POLLS_VIEW -->
	
	<div class="section-title">
		<h1>{POLLS_TITLE}</h1>
			
	</div>
	
	<div class="section-desc"></div>
	
	<div class="section-body">

		{POLLS_RESULTS}
		<p>
			{POLLS_VOTERS} {PHP.skinlang.polls.voterssince} {POLLS_SINCE}<br />
			{PHP.skinlang.polls.Comments} {POLLS_COMMENTS}{POLLS_COMMENTS_DISPLAY}
		</p>		
	</div>
	
	<!-- END: POLLS_VIEW -->
	
	
	<!-- BEGIN: POLLS_VIEWALL -->
	
	<div class="section-title">
		<h1>{PHP.skinlang.polls.Allpolls}</h1>
				
	</div>
	
	<div class="section-desc"></div>

	<div class="section-body">	

		{POLLS_LIST}

	</div>

	<!-- END: POLLS_VIEWALL -->


	<!-- BEGIN: POLLS_EXTRA -->

	<div class="section-block">

		{POLLS_EXTRATEXT}<br />{POLLS_VIEWALL}

	</div>

	<!-- END: POLLS_EXTRA -->	
	
	</div>

</main>

<!-- END: MAIN -->