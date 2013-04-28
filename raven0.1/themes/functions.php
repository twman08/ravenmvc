<?php
function base_url($url) {
	return CRaven::Instance()->request->base_url . trim($url, '/');
}

function current_url() {
	return CRaven::Instance()->request->current_url;
}