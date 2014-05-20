<style>
nav.be-breadcrumbs {
    height: 28px;
    margin: 0;
    padding: 0 10px;
    position: relative;
    text-align: left;	
}
nav.be-breadcrumbs ul {
	margin: 0;
	padding: 0;
}

nav.be-breadcrumbs ul li {
	display: inline-block;
	margin: 0;
	padding: 0;
}

nav.be-breadcrumbs ul li a {
    background: no-repeat scroll 100% 50% transparent;
	background-image: url(data:image/gif;base64,R0lGODlhDgAbAOYAAO7u7vb39/Lz8/Dx8fX19e3u7vz9/e/w8Pr7+8zMzPv8/ODg4Onq6vT19cTExMvLy+/v7/b29s7OztHR0djZ2crKysjIyOfn58/Q0OHi4ubm5sbGxtvb29zc3Nra2tzd3evr69PT0/Ly8t/f3/n6+tvc3NDQ0N3d3cfHx+Pj48TFxe3t7dfY2Pj5+dTU1NbW1uXl5fHx8eLi4vX29vPz8/Dw8Pf4+O7v7/T09PHy8vn5+fr6+vj4+Pv7+/39/ezt7fz8/P7+/v///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAAOABsAAAfygEI+CTxChoeIQUExE0FCipCRijIphpKKPpk+JjSYmpkGoQYzDwpBoqJAqqoXHIqrqj2ysy8rmbM9CLq7NhU6QQq7O8PEOyAhPkHEOszNzB0wPkDMPNXW1g84Pjs8Nt7f3xAJQD48Aefo6QsnqjPu7/ALH0AKBPb39yIO5BE4/v//JBzowQMHjYMIDy7wIOuggIcQBfzYQA5ijosYc6Bo0KMBxgEgQ7LIwC3kgBooUWoYByQlygMwDxRwQAJIjpgwb+i8gYFBCwI7dwIYOsJFjx1Dkw4tUICBih5AbjCdyvTHDws1dOSwyrUrhRI6bHQdGwgAOw==);
    color: #666;
    display: inline-block;
    font-size: 10px;
    font-weight: bold;
    height: 28px;
    line-height: 28px;
    padding: 0 20px 0 10px;
    text-decoration: none;
    vertical-align: middle;	
}

nav.be-breadcrumbs ul li a:hover {
	text-decoration: underline;
	color: #333;
}

</style>
<div class="module">
	<nav class="be-breadcrumbs">
		<?php #echo $this->Html->getCrumbs('&raquo;', __d('backend','Dashboard')); ?>
		<?php echo $this->Html->getCrumbList(array(), array(
			'url' => array('plugin'=>'backend','controller'=>'backend','action'=>'home'),
			'text' => __d('backend','Dashboard')		
		)); ?>
	</nav>
</div>