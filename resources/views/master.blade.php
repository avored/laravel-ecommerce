<!doctype html>
<html>
<head>
	@include('mage2::admin.includes.head')
</head>
<body>
    <header class="container-fluid">
		@include('mage2::admin.includes.header')
	    </header>
	    <div id="main" class="container-fluid">
	    	@yield('content')
	    </div>
	
	    <footer class="container-fluid">
	        <h1>Footer Area</h1>
	    </footer>

</body>
</html>