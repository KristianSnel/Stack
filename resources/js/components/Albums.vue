<template>
	<div class="content">
		<header>
			<h1>STACK Media Database</h1>
		</header>

		<div class="block">
			<h3>Administrator rights</h3>
			<button v-show="admin" id="adminButton" type="button" class="btn btn-success" @click="admin = !admin;">Enabled</button>
			<button v-show="!admin" id="adminButton" type="button" class="btn btn-danger" @click="admin = !admin;"> Disabled</button>
		</div>

		<div class="block pull-left">
			<div class="container">
				<h2>Albums</h2>
				<div class="row col-md-12">
					<div v-if="!albums || !albums.length">
						<h3>Nothing to see here!</h3>
					</div>
					<div class="col-md-4" v-else v-for="album in albums" v-bind:key="album.id">
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
					                  <button v-show="admin" type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
					                  <button type="button" class="btn btn-sm btn-outline-secondary">Details</button>
					                </div>
					                <small class="text-muted">{{album.date}}</small>
					              </div>
							</div>
						</div>
					</div>
					<div v-show="admin" class="col-md-4">
						<div class="card mb-4 shadow-sm">
							<svg v-show="!adding" class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
								<title>Placeholder</title>
								<rect width="100%" height="100%" fill="#5450e3"></rect>
								<text x="50%" y="50%" fill="#eceeef" dy=".3em">+</text>
							</svg>
							<svg v-show="adding" class="bd-placeholder-img card-img-top" width="100%" height="100">
								<rect width="100%" height="100%" fill="#5450e3"></rect>
							</svg>
							<title>Placeholder</title>
							<div class="card-body">
								<p v-show="!adding" class="card-text">Add new album</p>
					            <div v-show="!adding" class="btn-group">
				                  	<button type="button" class="btn btn-sm btn-outline-secondary" @click="adding = !adding; setFocus();">Add</button>
					            </div>
					            <form v-show="adding" @submit.prevent="addAlbum">
									<div class="form-row">
										<label for="inputstacktitle" class="col-form-label">Stack title</label>
				                  		<input id="inputstacktitle" v-model="album.title" ref="stacktitle" class="form-control"/>
				                  	</div>
									<div class="form-row">
										<label for="inputstacklink" class="col-form-label">Stack url</label>
				                  		<input id="inputstacklink" v-model="album.url" v-on:keyup.enter="adding = !adding; addAlbum();" v-show="adding" class="form-control"/>
				                  	</div>
				                  	<div class="form-row">
						                <button type="submit" class="btn btn-primary" @click="adding = !adding;">Submit</button>
							        </div>
				                </form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="sidebar block"><h2>Filter</h2>
			<div class="btn-group-vertical">
              <a class="btn btn-sm btn-outline-secondary" @click="fetchAlbums()">Reset</a>
              <a class="btn btn-sm btn-outline-secondary" @click="fetchAlbums('/api/albums/filter/maarten')">Maarten</a>
              <a class="btn btn-sm btn-outline-secondary" @click="fetchAlbums('/api/albums/filter/jacco')">Jacco</a>
              <a class="btn btn-sm btn-outline-secondary" @click="fetchAlbums('/api/albums/filter/Ralph')">Ralph</a>
              <a class="btn btn-sm btn-outline-secondary" @click="fetchAlbums('/api/albums/filter/Marnix')">Marnix</a>
              <a class="btn btn-sm btn-outline-secondary" @click="fetchAlbums('/api/albums/filter/Kris')">Kris</a>
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
				adding: 0,
				edit: false,
				admin: true
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
			},
			setFocus: function()
		    {
			    // Note, you need to add a ref="search" attribute to your input.
			    this.$refs.stacktitle.focus();
		    }, 
		    addAlbum: function()
		    {
		    	alert("yes");
		    	if(this.edit === false){
		    		//add
		    		//console.log(JSON.stringify(this.album));
		    		fetch('api/album', {
		    			method: 'post',
		    			body: JSON.stringify(this.album),
		    			headers: {
		    				'content-type': 'application/json'
		    			}
		    		})
		    		.then(res => res.json())
		    		.then(data => {
		    			this.album.title = '';
		    			this.album.url = '';
		    			this.fetchAlbums();

		    		});
		    	} else {
		    		//edit
		    	}
		    }
		}
	}


</script>


<style>
header{
	padding: 20px;
	background-color: #5450e3;
}

h1 {
	color: white;
	font-family: Helvetica,Arial,sans-serif;
	text-align: center;
	font-size: 50px;
}

.content {

}

.block {
	margin-top: 10px;
	background-color: #FFF;
	padding: 10px;
}


/* Moar css */

</style>