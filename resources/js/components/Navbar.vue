<template>
	<nav class="navbar">
		<div class="container navbar_content" style="height:45px;">
			<!--<ul class="navbar_items">
				<li class="navbar_item"><a class="navbar_link" href="/">Menu item</a></li>
				<li class="navbar_item"><a class="navbar_link" href="/">Menu item 2</a></li>
			</ul>-->
		</div>
	</nav>
</template>

<script>
	export default {
		data() {
			return {}
		}
	}
</script>

<style>


.navbar {
	background: #FFF;
}

.navbar_content

.navbar_items {
	list-style: none;
	display: flex;
}

.navbar_item {
	   box-sizing: inherit;
	   margin: 0 25px;
}

.navbar__item:last-child {
    margin-right: 0;
}

</style>