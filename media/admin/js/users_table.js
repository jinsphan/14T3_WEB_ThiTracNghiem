$(document).ready(function () {
	
	//UERS TABLE
	(function (users_table, $, undefine) {
			
		var numAllBtn = 0;
		var numBtnActive;
		var listChecked = [];
		var strFil = "";

		function fill_modal(data) {
			$('#username-modal td').eq(1).html(data.username);
			$('#email-modal td').eq(1).html(data.email);
			$('#avata-modal td').eq(1).html(data.avata);
			$('#firstname-modal td').eq(1).html(data.firstname);
			$('#lastname-modal td').eq(1).html(data.lastname);
			$('#phone-modal td').eq(1).html(data.phone);
			$('#address-modal td').eq(1).html(data.address);
			$('#role-modal td').eq(1).html(data.role);
			$('#status-modal td').eq(1).html(data.status);
			$('#created-modal td').eq(1).html(data.created);
		}

		function fill_row(id,data) {
			$('#tbody-users #username'+id).text(data.username);
			$('#tbody-users #email'+id).text(data.email);
			data.role = data.role=="1"?"admin":"user"
			data.status = data.status=="0"?"disable":(data.status=="1"?"Creating":"Enable")
			$('#tbody-users #status'+id).text(data.status);
			$('#tbody-users #created'+id).text(data.created);	
		}

		function upload_table(data) {
			var table_html = "";
			for(var i = 0; i<data.length; i++){
				var isChecked = ($.inArray(data[i].id, listChecked)>=0?"checked":"");
				data[i].status = data[i].status==0?"Disable":(data[i].status==1?"Creating":"Enable");
				table_html += "\
					<tr role='row'>\
						<td id='checkbox"+ data[i].id +"' class='checkboxUser'>\
							<input type='checkbox' name='' "+ isChecked +">\
						</td>\
						<td id='username"+ data[i].id +"'>"+ data[i].username +"</td>\
						<td id='email"+ data[i].id +"'>"+ data[i].email +"</td>\
						<td id='status"+ data[i].id +"'>"+ data[i].status +"</td>\
						<td id='created"+ data[i].id +"'>"+ data[i].created +"</td>\
						<td  class='btn-act' class='pull-right'>\
            	<button id='view"+ data[i].id + "' type='button' class='btn btn-success view-user' data-toggle='modal' data-target='#myModal'>\
            		<i class='fa fa-search-plus' aria-hidden='true'></i>\
            	</button>\
            	<button id='edit"+ data[i].id + "' type='button' class='btn btn-primary edit-user' data-toggle='modal' data-target='#myModal'>\
            		<i class='fa fa-pencil'></i>\
            	</button>\
            	<button id='dele" + data[i].id + "' type='button' class='btn btn-danger dele-user'>\
            		<i class='fa fa-trash-o'></i>\
            	</button>\
            </td>\
          </tr>\
				";
			}

			$('#tbody-users').html(table_html);
		}

		function get_modal() {
			var data = {
				'username': $('#modal-body #username-modal input').val(),
				'email': $('#modal-body #email-modal input').val(),
				'avata': $('#modal-body #avata-modal input').val(),
				'firstname': $('#modal-body #firstname-modal input').val(),
				'lastname': $('#modal-body #lastname-modal input').val(),
				'phone': $('#modal-body #phone-modal input').val(),
				'address': $('#modal-body #address-modal input').val(),
				'role': $('#modal-body #role-modal select').val(),
				'status': $('#modal-body #status-modal select').val(),
			}	
			return data;
		}

		function load_btnPaginate() {
			numAllBtn = Math.ceil(numAllUser/num_user_perPage);
			var btnPaginate_html = "\
				<li class='paginate_button previous' id='table_previous'>\
					<a href='javascript:void(0);'' aria-controls='table_user_ctent' data-dt-idx='0' tabindex='0'>Previous</a>\
				</li>\
			";

			for(var i = 1; i <= numAllBtn; i++){
				btnPaginate_html += "\
					<li class='paginate_button'>\
						<a href='javascript:void(0);'' aria-controls='example1' data-dt-idx= '"+i+"' tabindex='0'>"+i+"</a>\
					</li>\
				";
			}
			btnPaginate_html += "\
				<li class='paginate_button next' id='table_next'>\
					<a href='javascript:void(0);'' aria-controls='table_user_ctent' data-dt-idx='"+ (numAllBtn+1) +"'' tabindex='0'>Next\
					</a>\
				</li>\
			";

			$('#table_paginate .pagination').html(btnPaginate_html);
		}

		function delUser(id) {
			urlDele = "?pr=admin/account/del/"+ id;
			$.ajax({
				url: urlDele,
				success: function (data) {
					if(data != 'error'){
						numAllUser--;
						numBtnActive = parseInt($('#table_paginate .active a').attr('data-dt-idx'));
						load_btnPaginate();
						clickBtnPaginate(numBtnActive > numAllBtn?numAllBtn:numBtnActive);
					}
				}
			})
		}

		function clickBtnPaginate(numBtn) {

			var urlLoadData = "?pr=admin/account/ajax_loadData/"+numBtn + "/" + strFil;
			$.ajax({
				url: urlLoadData,
				dataType: "json",
				success: function (data) {
					if(data){
						upload_table(data[0]);
						numAllUser = data[1];
						// console.log(data[0]);
					}
				}
			}).done(function () {
				load_btnPaginate();
				//check disable button paginate
				var numNext = parseInt($('#table_paginate #table_next a').attr('data-dt-idx'));
				
				$('#table_paginate ul li').removeClass('disabled');
				if(numBtn == 1){
					$('#table_paginate #table_previous').addClass('disabled');
				}
				if(numBtn == numNext-1){
					$('#table_paginate #table_next').addClass('disabled');
				}

				$('#table_paginate ul li').removeClass('active');
				$('#table_paginate ul li').eq(numBtn).addClass('active');
				var showStart = (numBtn-1)*5+1;
				var showEnd = showStart + 5;
				if(showEnd > numAllUser ) showEnd = numAllUser;
				$('#table_info').text('Showing '+ showStart +' to '+ showEnd +' of '+ numAllUser +' entries');


			});
		}

		users_table.init = function () {

			//Paginate Click
			$('#table_paginate ul').off('click').on('click', '.paginate_button a', function () {
				var numBtn = parseInt($(this).attr('data-dt-idx'));
				var numNext = parseInt($('#table_paginate #table_next a').attr('data-dt-idx'));
				numBtnActive = parseInt($('#table_paginate .active a').attr('data-dt-idx'));

				if(numBtn == 0 || numBtn == numNext){
					if(numBtn == 0 && numBtnActive > 1){
						numBtnActive--;
					} 
					if(numBtn == numNext && numBtnActive < numNext-1){
						numBtnActive++;
					}
					clickBtnPaginate(numBtnActive);
				} else {
					clickBtnPaginate(numBtn);
				}
			})
			
			//View User

			$('#tbody-users').off('click').on('click','.btn-act button', function () {

				var typeAct = this.id.substring(0,4);
				var idAct = this.id.substring(4, this.id.length);
				var urlGetData = "?pr=admin/account/view/"+ idAct+"/";

				$('#myModal #modal-title').text(typeAct.toUpperCase() +' User');
								
				$.ajax({
					url: urlGetData,
					dataType: "json",
					success: function (data) {
						if(data){
							
							switch(typeAct){
								case 'view': {
									data.role = data.role=="1"?"admin":"user";
									data.status = data.status=="0"?"disable":(data.status=="1"?"Creating":"Enable");
									$('.modal-footer button').hide(0);
									$('.modal-footer #submit-btn-view').show(0);
									break;
								}
								case 'edit': {
									data.username = "<input class='form-control' type='text' value='"+data.username+"'/>";
									data.email = "<input class='form-control' type='text' value='"+data.email+"'/>";
									data.avata = "<input class='form-control' type='text' value='"+data.avata+"'/>";
									data.firstname = "<input class='form-control' type='text' value='"+data.firstname+"'/>";
									data.lastname = "<input class='form-control' type='text' value='"+data.lastname+"'/>";
									data.phone = "<input class='form-control' type='text' value='"+data.phone+"'/>";
									data.address = "<input class='form-control' type='text' value='"+data.address+"'/>";

									data.role = "\
										<div class='form-group'>\
										  <select class='form-control' id='sel1'>\
										    <option>"+data.role+"</option>\
										    <option>1</option>\
										    <option>2</option>\
										  </select>\
										</div>\
									";
									data.status = "\
										<div class='form-group'>\
										  <select class='form-control' id='sel1'>\
										  	<option>"+data.status+"</option>\
										  	<option>0</option>\
										    <option>1</option>\
										    <option>2</option>\
										  </select>\
										</div>\
									";
									$('.modal-footer button').hide(0);
									$('.modal-footer #submit-btn-done').show();

									$('.modal-footer #submit-btn-done').off('click').on('click', function () {
										var dataEdited = get_modal();

										var urlEdited = "?pr=admin/account/edit/"+ idAct+"/";

										$.ajax({
											url: urlEdited,
											data: dataEdited,
											type: 'POST',
											success: function (data) {
												if(data){
													alert(data);
													fill_row(idAct, dataEdited);
												}
											}
										})
									})
									break;
								}
								case 'dele': {
									var isDele = confirm("Are you sure?");
									if(isDele){
										delUser(idAct);
									}
									break;
								}
							}
							fill_modal(data); 
							
						}
					}
				})
			})

			//Add User
			$('#add-user').off('click').on('click', function () {
				var dataAddnew = {};
				dataAddnew.username = "<input class='form-control' type='text' value=''/>";
				dataAddnew.email = "<input class='form-control' type='text' value=''/>";
				dataAddnew.avata = "<input class='form-control' type='text' value=''/>";
				dataAddnew.firstname = "<input class='form-control' type='text' value=''/>";
				dataAddnew.lastname = "<input class='form-control' type='text' value=''/>";
				dataAddnew.phone = "<input class='form-control' type='text' value=''/>";
				dataAddnew.address = "<input class='form-control' type='text' value=''/>";

				dataAddnew.role = "\
					<div class='form-group'>\
					  <select class='form-control' id='sel1'>\
					    <option>2</option>\
					  </select>\
					</div>\
				";
				dataAddnew.status = "\
					<div class='form-group'>\
					  <select class='form-control' id='sel1'>\
					  	<option>0</option>\
					    <option>1</option>\
					    <option>2</option>\
					  </select>\
					</div>\
				";
				dataAddnew.created = "Auto";
				fill_modal(dataAddnew);
				
				$('.modal-footer button').hide(0);
				$('#modal-title').text('Add New');
				$('.modal-footer #submit-btn-add').show(0);

				$('.modal-footer #submit-btn-add').off('click').on('click', function () {
					var dataAddnew = get_modal();
					var urlAddnew = "?pr=admin/account/create/";
					$.ajax({
						url: urlAddnew,
						type: "POST",
						data: dataAddnew,
						success: function (data) {
							if(data != 'error'){
								numAllUser++;
								load_btnPaginate();
								clickBtnPaginate(numAllBtn);
							}
							alert(data);
						}
					})
				})
			})

			//Check to delete
			$('#table_user_ctent').on('click', '.checkboxUser', function () {
				var idCheckBox = this.id.substring(8, this.id.length);
				var isChecked = $(this).children().prop('checked');
				if(idCheckBox == 'All'){
					if(isChecked){
						var urlGetAllId = "?pr=admin/account/getAllId/" + strFil;
						$.ajax({
							url: urlGetAllId,
							dataType: 'json',
							success: function (data) {
								if(data){
									listChecked = data;
								}
							}
						})
					} else {
						listChecked = [];
					}
					
				} else {
					if(isChecked){
						listChecked.push(idCheckBox);
					} else {
						listChecked.splice($.inArray(idCheckBox, listChecked), 1);
					}
				}
				numBtnActive = parseInt($('#table_paginate .active a').attr('data-dt-idx')); 
				clickBtnPaginate(numBtnActive);
			})

			//Click To Delete User
			$('#delete-users').off('click').on('click', function () {
				if(listChecked.length > 0){
					var isDele = confirm("Are you sure!");
					if(isDele){
						_.each(listChecked, function (id, index) {
							delUser(id);
						})
						listChecked = [];
						numBtnActive = parseInt($('#table_paginate .active a').attr('data-dt-idx')); 
						clickBtnPaginate(numBtnActive);
					}
				} else {
					alert("Nobody to delete!");
				}
			})

			//Table Filter

			$('#table_filter input').on('keyup', function (e) {
				if(e.which == 13){
					strFil = $(this).val().trim();
					clickBtnPaginate(1);
				} 
			})
			$('#submit-search').off('click').on('click', function () {
				clickBtnPaginate(1);
			})
				
		}
	}(window.users_table = window.users_table || {}, jQuery))
	
	users_table.init();

	//END USERS TABLE
})