function changeImage(id) {
	let imagechitiet = document.getElementById(id).getAttribute('src');
	document.getElementById('hinhchu').setAttribute('src',imagechitiet);
}