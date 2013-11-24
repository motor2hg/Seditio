<!-- BEGIN: HEADER -->{HEADER_DOCTYPE}
<html>
<head>
{HEADER_METAS}
{HEADER_COMPOPUP}
<title>{HEADER_TITLE}</title>
<link href="skins/{PHP.skin}/{PHP.skin}.css" type="text/css" rel="stylesheet" />
<link rel="canonical" href="{HEADER_CANONICAL_URL}" />
</head>

<body>

<div id="wrapper">

<div id="top-line"></div>

  <!-- BEGIN: USER -->    
  <div class="user">       
    <div class="user-menu">    
    <ul>
      <li style="padding-right:15px;">{HEADER_NOTICES}</li>
      <li><span>{HEADER_LOGSTATUS}</span></li>
      <li>{HEADER_USER_ADMINPANEL}</li>
      <li>{HEADER_USERLIST}</li>
      <li>{HEADER_USER_PROFILE}</li>
      <li>{HEADER_USER_PFS}</li>
      <li>{HEADER_USER_PMREMINDER}</li>
      <li>{HEADER_USER_LOGINOUT}</li>
    </ul>
    </div>
  </div>    
  <!-- END: USER -->
  
  <!-- BEGIN: GUEST -->
  <div class="auth">
    <div class="user-menu">
    <ul>
      <li><a href="{PHP.out.auth_link}"><i class="icons grey people"></i> {PHP.skinlang.header.Login}</a></li>
      <li><a href="{PHP.out.register_link}"><i class="icons grey plus"></i> {PHP.skinlang.header.Register}</a></li>
    </ul>
    </div>
  </div>
  <!-- END: GUEST -->  
 

<div id="conteiner">
 
<div id="header">
    <div class="container row">
    <!-- Logo -->
		<div class="split half">
			<div id="logo">
				<a href="/" class="logos"></a>
				<div id="slogan">It's time will come soon!</div>
				<div class="clear"></div>
			</div>
		</div>
		<!-- Social / Contact -->
		<div class="split half">  			
			<!-- Social Icons -->

			<!-- Search -->
			<div class="top-search">
				<form name="login" action="plug.php?e=search&a=search" method="post">
					<button class="search-btn"></button>
					<input class="search-field" type="text" onblur="if(this.value=='')this.value='{PHP.L.Search}';" onfocus="if(this.value=='{PHP.L.Search}')this.value='';" value="{PHP.L.Search}" />
				</form>
			</div>



		</div>
    </div>             	     
</div>

</div>
  
<div id="nav"> 
<div class="left-corner"></div>
    {PHP.cfg.menu1}          

			<ol class="social-icons">
				<li class="twitter"><a href="#">Twitter</a></li>      
				<li class="facebook"><a href="#">Facebook</a></li>
				<li class="dribbble"><a href="#">Dribbble</a></li>
				<li class="linkedin"><a href="#">LinkedIn</a></li>
				<li class="rss"><a href="#">Rss</a></li>
			</ol>  



             
<div class="right-corner"></div>
</div>  

<div id="conteiner">

<div id="main">

<!-- END: HEADER -->