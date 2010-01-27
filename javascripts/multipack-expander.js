
MultiPackExpander.prototype.makeVisible = function (elemImageRow, elemTitleRow, elemPercentageRow, elemSimsRow) {
	var imageChildren = elemImageRow.getElementsByTagName("td");
	var textChildren = elemTitleRow.getElementsByTagName("td");
	if (elemPercentageRow != null) {
		var percentChildren = elemPercentageRow.getElementsByTagName("td");
	}
	if (elemSimsRow != null) {
		var simsChildren = elemSimsRow.getElementsByTagName("td");
	}
	var noOfCols = Math.floor(Math.min(imageChildren.length, (elemImageRow.offsetWidth / this.minimumItemWidth)));
	noOfCols = Math.max(this.minimumItems, noOfCols);
	var width = (100 / noOfCols - 1) + "%";
	for (var i = 0; i < imageChildren.length; i++) {
		if (i < noOfCols) {
			imageChildren[i].style.display = "";
			imageChildren[i].style.width = width;
			textChildren[i].style.display = "";
			textChildren[i].style.width = width;
			if (percentChildren != null) {
				percentChildren[i].style.display = "";
				percentChildren[i].style.width = width;
			}
			if (simsChildren != null) {
				simsChildren[i].style.display = "";
				simsChildren[i].style.width = width;
			}
		} else {
			imageChildren[i].style.display = "none";
			textChildren[i].style.display = "none";
			if (percentChildren != null) {
				percentChildren[i].style.display = "none";
			}
			if (simsChildren != null) {
				simsChildren[i].style.display = "none";
			}
		}
	}
	return width;
};
MultiPackExpander.prototype.makeS9Visible = function () {
	var elemImageRow = document.getElementById(this.imageRowId);
	if (elemImageRow != null) {
		var elemTitleRow = document.getElementById(this.titleRowId);
		var elemPercentageRow = document.getElementById(this.percentageRowId);
		var elemSimsRow = document.getElementById(this.simsRowId);
		var width = this.makeVisible(elemImageRow, elemTitleRow, elemPercentageRow, elemSimsRow);
		var elemSeedTitleRow = document.getElementById(this.seedTitleRowId);
		if (elemSeedTitleRow != null) {
			var elemSeedTitleRowChildren = elemSeedTitleRow.getElementsByTagName("td");
			if (elemSeedTitleRowChildren.length > 0) {
				elemSeedTitleRowChildren[0].style.width = width;
			}
		}
	}
};
function MultiPackExpander(imageRowId, titleRowId, seedTitleRowId, percentageRowId, simsRowId, minimumItems, minimumItemWidth) {
	this.imageRowId = imageRowId;
	this.titleRowId = titleRowId;
	this.seedTitleRowId = seedTitleRowId;
	this.percentageRowId = percentageRowId;
	this.simsRowId = simsRowId;
	this.minimumItems = minimumItems;
	this.minimumItemWidth = minimumItemWidth;
		
	var obj = this;
	var callbackReference = this.makeS9Visible;
	var callback = function () {
		callbackReference.call(obj);
	};
	if (window.addEventListener) {
		window.addEventListener("load", callback, false);
		window.addEventListener("resize", callback, false);
	} else {
		window.attachEvent("onload", callback);
		window.attachEvent("onresize", callback);
	}
}

