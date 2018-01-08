<?php

// Variable de version du script
$version = 'VERSION 1.3';

// Variables d'initialisation
$topbar_text = '$topbar_text - éditez moi dans <b>biv.php</b>';
$stopinfo_text = '$stopinfo_text - éditez moi dans <b>biv.php</b>';

?>

<html style="overflow: hidden;">
<head>
<link rel="stylesheet" href="./css/ajax-bootstrap-select.css"/>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap.min.css"/>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/bulma.css">
<link rel="stylesheet" href="./css/bulma-docs.css">
<link rel="stylesheet" href="./css/lignes.css.css">
<link rel="stylesheet" href="./css/lignes.borders.css.css">
<link rel="stylesheet" href="./css/pictro-bus.css">
<link rel="stylesheet" href="./css/custom.css">
<script src="./js/jquery-3.1.1.min.js"></script>

</head>
<body>
	<section class="hero is-fullheight">
		<div class="hero-head">
			<!-- BARRE DU HAUT -->
			<div class="bd-version">
				<section class="hero is-primary">
				  <div class="hero-body" style="padding: 0.5rem 0.5rem 0.5rem 1.5rem;">
					<nav class="level" id="header" style="width:100%;">
					  <div class="level-left">
						<div class="level-item">
						  <p class="title is-size-2">
							<?php echo $topbar_text; ?>
						  </p>
						</div>
					  </div>
					  <div class="level-right">
						<div class="level-item">
						  <p class="title is-3" style="margin-right: 1em;">
							<a id="date" class="is-primary is-outlined title is-3 is-loading" style="background-color:#00d1b2; color:white; font-weight:500;font-size: 3rem;">INIT</a>
						  </p>
						   <p class="title is-3">
							<a id="adminb" class="button is-primary title is-3" style="background-color:#00d1b2;color:white ; font-weight:500;font-size: 1.2rem;" data-target="#modala">
								<span class="icon">
									<i class="fa fa-cog"></i>
								</span>
							</a>
						  </p>
						</div>
					  </div>
					</nav>
				  </div>
				</section>
			</div>
			<div id="bd-version-tag" class="bd-tag">INIT</div>
			<div id="bd-client-tag" class="bd-tag">INIT</div>
			<div id="bd-hote-tag" class="bd-tag">INIT</div>
			
			
			<!-- SUB INFO -->
			<div class="columns">
			  <div class="column" style="padding-top: 0.2rem;">
				<p class="bd-notification title is-3 is-white" style="padding-top: 0.2rem;"><?php echo $stopinfo_text; ?></p>
			  </div>
			</div>
		</div>

		<div class="hero-body" style="padding:0">
			<div id="lineslist" class="container">
			<?php
			// Ouverture du fichier des lignes
			$handle = fopen("./conf/lines.conf", "r");
			if ($handle) {
				while (($line = fgets($handle)) !== false) {
					$res = explode(";",$line);
					$res[2] = str_replace("\n", '', $res[2]);
					$res[2] = str_replace("\r", '', $res[2]);
					$picto_ligne ='';
					?>
					<div class="tile is-ancestor">
						<div class="tile is-parent is-line-info-left" style="line-height: initial;">
							<div class="tile column is-child box is-size-3 bd-notification has-text-weight-bold ligne<?php echo $res[0]; ?> ligneBorders<?php echo $res[0]; ?> is-size-1 has-text-centered">
								<?php echo $res[0]; ?>
							</div>
						</div>
						<div class="tile is-10 is-vertical is-parent ">
							<div class="tile is-child" style="margin-bottom: 0">
								<div class="columns is-mobile is-line-info-right" id="<?php echo $res[0].'Anav'; ?>">
									<div class="column is-four-fifths has-text-centered">
										<p class="bd-notification is-size-3 is-dark has-text-weight-bold" style="border-radius: 0;" id="<?php echo $res[0].'Adirection'; ?>">
											INIT
										</p>
									</div>
									<div class="column">
										<p class="bd-notification is-size-3 is-dark has-text-weight-bold" style="border-radius: 0;" id="<?php echo $res[0].'A1';?>">
											INIT
										</p>
									</div>
									<div class="column">
										<p class="bd-notification is-size-3 is-dark has-text-weight-bold" style="border-radius: 0;" id="<?php echo $res[0].'A2';?>">
											INIT
										</p>
									</div>
								</div>
							</div>
							<div class="tile is-child" style="margin-bottom: 0">
								<div class="columns is-mobile is-line-info-right" id="<?php echo $res[0].'Bnav'; ?>">
									<div class="column is-four-fifths has-text-centered">
										<p class="bd-notification is-size-3 is-dark has-text-weight-bold is-margin-top" style="border-radius: 0;" id="<?php echo $res[0].'Bdirection'; ?>">
											INIT
										</p>
									</div>
									<div class="column">
										<p class="bd-notification is-size-3 is-dark has-text-weight-bold is-margin-top" style="border-radius: 0;" id="<?php echo $res[0].'B1';?>">
											INIT
										</p>
									</div>
									<div class="column">
										<p class="bd-notification is-size-3 is-dark has-text-weight-bold is-margin-top" style="border-radius: 0;" id="<?php echo $res[0].'B2';?>">
											INIT
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>				
				<?php
				}
				fclose($handle);
			} else {
				// error opening the file.
			}
			?>
			</div>
		</div>
		
		
	</section>
	
	<div id="modala" class="modal">
	  <div class="modal-background"></div>
	  <div class="modal-card" style="width: 800px;">
		<header class="modal-card-head">
		  <p class="modal-card-title">Administration</p>
		  <button id="closeb" class="delete"></button>
		</header>
		<section class="modal-card-body">
		
			<div class="columns">
				<div class="column">
					<div class="field">
						<label class="label">Indice</label>
						<p class="control" id="indiceaddbcontrol">
							<span style="display:none;" id="indicesave">Tapez un indice...</span>
							<!-- <input id="indiceaddb" class="input" type="text" placeholder="ex: 113"> -->
							<select id="indiceaddb" class="selectpicker with-ajax" data-live-search="true"></select>
						</p>
						<p id="indiceerror" class="help is-danger" style="display:none;">Valeur incorrecte</p>
					</div>
				</div>
				<div class="column">
					<div class="field">
						<label class="label">Nom du point d'arrêt</label>
						<p class="control">
							<select id="lienbaddb" disabled class="selectpicker with-ajax" data-live-search="true"></select>
							<!--<input id="lienbaddb" class="input" type="text" placeholder="ex: Neuilly-Plaisance">-->
						</p>
						<p id="lienberror" class="help is-danger" style="display:none;">Valeur incorrecte</p>
					</div>
				</div>
				<div class="column">
					<div class="field">
						<label class="label">RER?</label>
						<p class="control has-text-centered">
							<label class="checkbox">
							<input id="reraddb" type="checkbox">
							</label>
						</p>
					</div>
				</div>
				<div class="column">
					<div class="field">
						<label class="label">Ajout</label>
						<p class="control has-text-centered">
							<a class="button is-info" id="ajoutb">
								<span class="icon">
									<i class="fa fa-plus"></i>
								</span>
							</a>
						</p>
					</div>
				</div>
			</div>
		<div id="lineslistfromfile">
		<?php
		$handle = fopen("./conf/lines.conf", "r");
		if ($handle) {
			while (($line = fgets($handle)) !== false) {
				$res = explode(";",$line);
				$rand = rand(0, 100);
				echo '<div class="columns" id="columns'.$res[0].$rand.'">
						<div class="column">
							<div class="field">
								<label class="label">Indice de ligne</label>
								<p class="control">
									<input class="input" type="text" disabled value="'.$res[0].'" placeholder="ex: 113"">
								</p>
							</div>
						</div>
						<div class="column">
							<div class="field">
								<label class="label">Nom du point d\'arrêt</label>
								<p class="control">
									<input class="input" type="text" disabled value="'.$res[1].'" placeholder="ex: Neuilly-Plaisance">
								</p>
							</div>
						</div>
						<div class="column">
							<div class="field">
								<label class="label">RER?</label>
								<p class="control has-text-centered">
									<label class="checkbox">
									<input type="checkbox" disabled disabled '.($res[2] != 0 ? 'checked' : '').'>
									</label>
								</p>
							</div>
						</div>
						<div class="column">
							<div class="field">
								<label class="label">Suppr</label>
								<p class="control has-text-centered">
									<a class="button is-danger" id="deleteb'.$res[0].$rand.'">
										<span class="icon">
											<i class="fa fa-close"></i>
										</span>
									</a>
								</p>
							</div>
						</div>
					</div>	
					<script>
					$( "#deleteb'.$res[0].$rand.'" ).click(function() {
						$( "#columns'.$res[0].$rand.'" ).remove();
					});
					</script>
					';
			}

			fclose($handle);
		} else {
			// error opening the file.
		}
		?>
		</div>
		</section>
		<footer class="modal-card-foot">
		  <a class="button is-success" id="saveb">Enregistrer</a>
		  <a class="button" id="cancelb">Annuler</a>
		</footer>
	  </div>
	</div>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="./js/ajax-bootstrap-select.js"></script>
<script>
	
/***********************************************/
// GESTION DES BOUTONS DU MODAL D'ADMINISTRATION
/***********************************************/
$( "#adminb" ).click(function() {
	$( "#modala" ).toggleClass( "is-active" );
});

$( "#closeb" ).click(function() {
	$( "#modala" ).toggleClass( "is-active" );
});

$( "#ajoutb" ).click(function() {
	console.log('ajout');
	var check = 0;
	if ( ($("button[data-id='indiceaddb']").attr('title') == '') || ($("button[data-id='indiceaddb']").attr('title') == 'Tapez un indice...') || ($("button[data-id='indiceaddb']").attr('title') == 'null') ) {
		$( "#indiceaddb" ).addClass( "is-danger" );
		$( "#indiceerror" ).show();
		check = 1;
	}
	else {
		$( "#indiceerror" ).hide();
		$( "#indiceaddb" ).removeClass( "is-danger" );
	}
	if ( ($("button[data-id='lienbaddb']").attr('title') == '') || ($("button[data-id='lienbaddb']").attr('title') == 'Tapez un point darrêt...') || ($("button[data-id='lienbaddb']").attr('title') == 'Nothing selected') || ($("button[data-id='lienbaddb']").attr('title') == 'null') ) {
		$( "#lienbaddb" ).addClass( "is-danger" );
		$( "#lienberror" ).show();
		check = 1;
	}
	else {
		$( "#lienberror" ).hide();
		$( "#lienbaddb" ).removeClass( "is-danger" );
	}
	
	
	if(check==0) {
		// add dom
		var is_checked = '';
		if ($('#reraddb').prop('checked')) is_checked = 'checked';
		var rand = Math.floor((Math.random() * 10) + 1);
		var newdom = '<div class="columns" id="columns'+$( "#indiceaddb" ).val()+rand+'">';
		newdom += '<div class="column">';
		newdom += '<div class="field">';
		newdom += '<label class="label">Indice de ligne</label>';
		newdom += '<p class="control">';
		newdom += '<input class="input" disabled type="text" value="'+$("button[data-id='indiceaddb']").attr('title')+'" placeholder="ex: 113"">';
		newdom += '</p>';
		newdom += '</div>';
		newdom += '</div>';
		newdom += '<div class="column">';
		newdom += '<div class="field">';
		newdom += '<label class="label">Nom du point d\'arrêt</label>';
		newdom += '<p class="control">';
		newdom += '<input class="input" disabled type="text" value="'+$( "#lienbaddb" ).val()+'" placeholder="ex: Neuilly-Plaisance">';
		newdom += '</p>';
		newdom += '</div>';
		newdom += '</div>';
		newdom += '<div class="column">';
		newdom += '<div class="field">';
		newdom += '<label class="label">RER?</label>';
		newdom += '<p class="control has-text-centered">';
		newdom += '<label class="checkbox">';
		newdom += '<input type="checkbox" disabled '+is_checked+'>';
		newdom += '</label>';
		newdom += '</p>';
		newdom += '</div>';
		newdom += '</div>';
		newdom += '<div class="column">';
		newdom += '<div class="field">';
		newdom += '<label class="label">Suppr</label>';
		newdom += '<p class="control has-text-centered">';
		newdom += '<a class="button is-danger" id="deleteb'+$( "#indiceaddb" ).val()+rand+'">';
		newdom += '<span class="icon">';
		newdom += '<i class="fa fa-close"></i>';
		newdom += '</span>';
		newdom += '</a>';
		newdom += '</p>';
		newdom += '</div>';
		newdom += '</div>';
		newdom += '</div>';
		
		$( "#lineslistfromfile" ).append(newdom);
		$( "#indiceaddb" ).val("");
		$( "#indiceaddb" ).removeClass( "is-danger" );
		$( "#indiceerror" ).hide();
		$( "#lienbaddb" ).val("");
		$( "#lienbaddb" ).removeClass( "is-danger" );
		$( "#lienberror" ).hide();
	}
	
});

$( "#saveb" ).click(function() {
	$.get( "./php/clear.php" , 
		function( data ) {
		}
	, "json" );
	
	$('#lineslistfromfile').children('.columns').each(function () {
		var output = new Array(3);
		$('input', this).each(function(index, elem) {
			if(index!=2) output[index] = $(elem).val();
			else {
				if ($(elem).prop('checked')) output[index] = 1;
				else output[index] = 0;
			}	
		});
		console.log(output[0]+';'+output[1]+';'+output[2]);
		$.get( "./php/save.php", { indice : output[0], urlb : output[1], isrer : output[2] } , 
			function( data ) {
				console.log('written : ' + data.line);
			}
		, "json" );
	});
	//location.reload();
});

$( "#cancelb" ).click(function() {
	$( "#modala" ).toggleClass( "is-active" );
});

	
/***********************************************/
// GESTION DE L'AJAX POUR LES INDICES DE LIGNES
/***********************************************/
var options = {
	ajax          : {
		url     : './php/ajax.php',
		type    : 'POST',
		dataType: 'json',
		data    : {
			q: '{{{q}}}'
		}
	},
	locale        : {
		emptyTitle: 'Tapez un indice...'
	},
	log           : 3,
	preprocessData: function (data) {
		var i, l = data.length, array = [];
		if (l) {
			for (i = 0; i < l; i++) {
				var iconL = 'fa-bus';
				
				if(data[i].reseau=='metro') iconL = 'fa-subway';
				else if (data[i].reseau=='rer') iconL = 'fa-train';
				else iconL = 'fa-bus';
				array.push($.extend(true, data[i], {
					text : data[i].code,
					value: data[i].id,
					data : {
						subtext: data[i].name,
						icon: 'fa ' + iconL,
					}
				}));
			}
		}
		return array;
	}
};


$('#indiceaddb').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);


var observer = new MutationObserver(function(mutations) {
  mutations.forEach(function(mutation) {
    if (mutation.attributeName === "class") {
      var attributeValue = $(mutation.target).prop(mutation.attributeName);
	  if($(mutation.target).hasClass("open")) {
	  } else {
			if( ($("#indiceaddbcontrol .btn-group .pull-left").html() != 'Tapez un indice...') && ($("#indiceaddbcontrol .btn-group .pull-left").html() != $("#indicesave").html() ) ) {
			  $("#indicesave").html($("#indiceaddbcontrol .btn-group .pull-left").html());
		}
	  }
    }
  });
});
observer.observe($("#indiceaddbcontrol .btn-group")[0], {
  attributes: true
});

$("#indiceaddb").change(function() {
  if ($("#indiceaddb").val()!=null) {
	  $('#lienbaddb').prop('disabled', false);
	  $("button[data-id='lienbaddb']").removeClass( "disabled" );
	  if($('#lienbaddb').selectpicker().list!=null) $('#lienbaddb').selectpicker().setTitle('Tapez un point darrêt...');
	  var optionsPA = {
		ajax          : {
			url     : './php/ajax1.php?id='+$("#indiceaddb").val(),
			type    : 'POST',
			dataType: 'json',
			data    : {
				station_name: '{{{q}}}'
			}
		},
		locale        : {
			emptyTitle: 'Tapez un point darrêt...'
		},
		log           : 3,
		preprocessData: function (data) {
			var i, l = data.length, array = [];
			if (l) {
				for (i = 0; i < l; i++) {
					
					array.push($.extend(true, data[i], {
						text : data[i].name,
						value: data[i].name,
						data : {
							subtext: data[i].name,
						}
					}));
				}
			}
			return array;
		}
	};
	$('#lienbaddb').selectpicker().filter('.with-ajax').ajaxSelectPicker(optionsPA);
	$('#lienbaddb').data('AjaxBootstrapSelect').options.ajax.url = '/ratp/ajax1.php?id='+$("#indiceaddb").val();
	
  } else {
	  $('#lienbaddb').prop('disabled', 'disabled');
	  $("button[data-id='lienbaddb']").addClass( "disabled" );
	  if($('#lienbaddb').selectpicker().list!=null) $('#lienbaddb').selectpicker().setTitle('Tapez un point darrêt...');
  }
});


/***********************************************/
// CONSULTATION DE L'OPEN DATA ET MAJ DU HTML
/***********************************************/
function upDate() {
	console.log("**************************************** UPDATE CALL ***********************************************");
	<?php
	$handle = fopen("./conf/lines.conf", "r");
	if ($handle) {
		while (($line = fgets($handle)) !== false) {
			$res = explode(";",$line);
			$res[2] = str_replace("\n", '', $res[2]);
			$res[2] = str_replace("\r", '', $res[2]);
			echo '
			$.get( "./php/get_next_missions_by_refs1.php", { code: "'.$res[0].'", station_name: "'.$res[1].'" } , 
				function( data ) {
					console.log(data);
					
					if(data.directions[0].next_missions!=null) {
						if (data.directions[0].next_missions[0].end != data.directions[0].station_name) {
							var dirA1 = data.directions[0].next_missions[0].end;
							var dirA2 = data.directions[0].next_missions[1].end;
							$("#'.$res[0].'Adirection").html(dirA1);
							$("#'.$res[0].'Adirection1").html(dirA2);
						}	
						else {
							$("#'.$res[0].'Adirection").text("-");
							$("#'.$res[0].'Adirection1").text("-");
						}
					} else {
						$("#'.$res[0].'Adirection").text("Service terminé");
						$("#'.$res[0].'Adirection1").text("Service terminé");
					}
					if(data.directions[1].next_missions!=null) {
						if (data.directions[1].next_missions[0].end != data.directions[0].station_name) {
							var dirB1 = data.directions[1].next_missions[0].end;
							var dirB2 = data.directions[1].next_missions[1].end;
							$("#'.$res[0].'Bdirection").html(dirB1);
							$("#'.$res[0].'Bdirection1").html(dirB2);
						}
						else {
							$("#'.$res[0].'Bdirection").text("-");
							$("#'.$res[0].'Bdirection1").text("-");
						}
					} else {
							$("#'.$res[0].'Bdirection").text("Service terminé");
							$("#'.$res[0].'Bdirection1").text("Service terminé");
					}
					if(data.directions[0].next_missions!=null) {
						$("#'.$res[0].'A1button").addClass( "mini_text" );
						$("#'.$res[0].'A1button").removeClass( "maxi_text" );
						$("#'.$res[0].'Anav").show();
					} else {
						$("#'.$res[0].'A1button").removeClass( "mini_text" );
						$("#'.$res[0].'A1button").addClass( "maxi_text" );
						$("#'.$res[0].'Anav").show();
					}
					$("#'.$res[0].'A1button").removeClass( "is-loading" );
					
					if(data.directions[0].next_missions!=null) {
						$("#'.$res[0].'A2button").addClass( "mini_text" );
						$("#'.$res[0].'A2button").removeClass( "maxi_text" );
						$("#'.$res[0].'Anav1").show();
					} else {
						$("#'.$res[0].'A2button").removeClass( "mini_text" );
						$("#'.$res[0].'A2button").addClass( "maxi_text" );
						$("#'.$res[0].'Anav1").show();
					}
					$("#'.$res[0].'A2button").removeClass( "is-loading" );
					
					if(data.directions[1].next_missions!=null) {
						$("#'.$res[0].'B1button").addClass( "mini_text" );
						$("#'.$res[0].'B1button").removeClass( "maxi_text" );
						$("#'.$res[0].'Bnav").show();
					} else {
						$("#'.$res[0].'B1button").removeClass( "mini_text" );
						$("#'.$res[0].'B1button").addClass( "maxi_text" );
						$("#'.$res[0].'Bnav").show();
					}
					$("#'.$res[0].'B1button").removeClass( "is-loading" );
					
					if(data.directions[1].next_missions!=null) {
						$("#'.$res[0].'B2button").addClass( "mini_text" );
						$("#'.$res[0].'B2button").removeClass( "maxi_text" );
						$("#'.$res[0].'Bnav1").show();
					} else {
						$("#'.$res[0].'B2button").removeClass( "mini_text" );
						$("#'.$res[0].'B2button").addClass( "maxi_text" );
						$("#'.$res[0].'Bnav1").show();
					}
					$("#'.$res[0].'B2button").removeClass( "is-loading" );
					if(data.directions[0].next_missions!=null) {
						if (data.directions[0].next_missions[0].end != data.directions[0].station_name) $("#'.$res[0].'A1").text(data.directions[0].next_missions[0].time_fmt);
						else {
							$("#'.$res[0].'A1").text("-");
							$("#'.$res[0].'Anav").hide();
						}
					} else {
						$("#'.$res[0].'A1").text("-");
					}
					if(data.directions[0].next_missions!=null) {
						if (data.directions[0].next_missions[1].end != data.directions[0].station_name) $("#'.$res[0].'A2").text(data.directions[0].next_missions[1].time_fmt);
						else {
							$("#'.$res[0].'A2").text("-");
							$("#'.$res[0].'Anav1").hide();
						}
					} else {
						$("#'.$res[0].'A2").text("-");
						$("#'.$res[0].'Anav1").hide();
					}
					if(data.directions[1].next_missions!=null) {
						if (data.directions[1].next_missions[0].end != data.directions[1].station_name) $("#'.$res[0].'B1").text(data.directions[1].next_missions[0].time_fmt);
						else {
							$("#'.$res[0].'B1").text("-");
							$("#'.$res[0].'Bnav").hide();
						}
					} else {
						if (data.directions[1].name == data.directions[1].station_name) {
							$("#'.$res[0].'B1").text("-");
							$("#'.$res[0].'Bnav").hide();
						}
						else $("#'.$res[0].'B1").text("--");
					}
					if(data.directions[1].next_missions!=null) {
						if (data.directions[1].next_missions.length>=2) {
							if (data.directions[1].next_missions[1].end != data.directions[1].station_name) $("#'.$res[0].'B2").text(data.directions[1].next_missions[1].time_fmt);
							else {
								$("#'.$res[0].'B2").text("-");
								$("#'.$res[0].'Bnav1").hide();
							}
						} else {
							$("#'.$res[0].'B2").text("-");
							$("#'.$res[0].'Bnav1").hide();
						}
					} else {
						$("#'.$res[0].'B2").text("-");
						$("#'.$res[0].'Bnav1").hide();
					}
					
					$("#date").text(data.date);
					$("#date").removeClass( "is-loading" );	
				}
			, "json" );
			';
		}

		fclose($handle);
	} else {
		// error opening the file.
	}
	?>
}

function setReferers() {
	$("#bd-version-tag").text("<?php echo $version; ?>");
	$("#bd-client-tag").text("CLIENT:<?php echo $_SERVER['REMOTE_ADDR']; ?>");
	$("#bd-hote-tag").text("HOTE:<?php echo $_SERVER['SERVER_NAME']; ?>");
}

setReferers();
upDate();
setInterval(function() {upDate()}, 60*1000);


</script>	
	
</body>
</html>