<template>
	<div>
		<header>
			<h1>STACK Media Database</h1>
		</header>
		<h2>Filter</h2>
		<div class="">
			<div class="btn-group">
              <a class="btn btn-sm btn-outline-secondary" @click="fetchAlbums()">Reset</a>
              <a class="btn btn-sm btn-outline-secondary" @click="fetchAlbums('/api/albums/filter/maarten')">Maarten</a>
              <a class="btn btn-sm btn-outline-secondary" @click="fetchAlbums('/api/albums/filter/jacco')">Jacco</a>
              <a class="btn btn-sm btn-outline-secondary" @click="fetchAlbums('/api/albums/filter/Ralph')">Ralph</a>
              <a class="btn btn-sm btn-outline-secondary" @click="fetchAlbums('/api/albums/filter/Marnix')">Marnix</a>
              <a class="btn btn-sm btn-outline-secondary" @click="fetchAlbums('/api/albums/filter/Kris')">Kris</a>
            </div>
		</div>
		<h2>Albums</h2>
		<div class="container">
			<div class="row col-md-12">
				<div class="col-md-4" v-for="album in albums" v-bind:key="album.id">
					<div class="card mb-4 shadow-sm">
						<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
							<title>Placeholder</title>
							<rect width="100%" height="100%" fill="#5450e3"></rect>
							<text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
						</svg>
						<title>Placeholder</title>
						<div class="card-body">
							<p class="card-text">{{ album.title }}</p>
							<div class="d-flex justify-content-between align-items-center">
				                <div class="btn-group">
				                  <a class="btn btn-sm btn-outline-secondary" :href="album.url" target="_blank">View</a>
				                  <button type="button" class="btn btn-sm btn-outline-secondary">Details</button>
				                </div>
				                <small class="text-muted">{{album.date}}</small>
				              </div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				albums: [],
				album: {
					id: '',
					title: '',
					description: '',
					location: '',
					date: '',
					count: '',
					tags: '',
					url: ''
				},
				album_id: '',
				pagination: {},
				edit: false
			}
		},

		created(){
			this.fetchAlbums();
		},

		methods: {
			fetchAlbums(page_url) {
				page_url = page_url || '/api/albums';
				fetch(page_url)
				.then(res => res.json())
				.then(res => {
					this.albums = res.data;
				})
				.catch(err => console.log(err));
			}
		}
	}


</script>


<style>
header{
	height: 200px;
	background-color: #5450e3;
}

h1 {
	padding-top: 50px;
	color: white;
	font-family: Helvetica,Arial,sans-serif;
	text-align: center;
	font-size: 50px;
}

/* Moar css */

</style>