@extends('layouts.main')
@section('title','Dashboard'." | ")

@section('content')

@php
  $fixAssetUrl = asset('/frontend')."/";
@endphp

<div class="dashboard-tier1">
	<div class="row">
		<div class="col-sm-5">
			<div class="items item1">
				<h5>Unlimited Cashback</h5>
				<p>Etiam eget ante metus. Suspendisse aliquam risus id posuere cursus</p>
				<div class="btn-container"><a href="#">Add New Node <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.33337 4H10.6667" stroke="#5129F1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> <path d="M8 6.66667L10.6667 4" stroke="#5129F1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 1.33337L10.6667 4.00004" stroke="#5129F1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></a></div>
			</div>
		</div>
		<div class="col-sm-7">
			<div class="row">
				<div class="col-sm-4">
					<div class="items item2">
						<div class="text1">Total rewards earned</div>
						<div class="text2">$35 752.45</div>
						<div class="graphimg"><img src="{{$fixAssetUrl}}img/stats.png" /></div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="items item2">
						<div class="text1">Total rewards earned</div>
						<div class="text2">$35 752.45</div>
						<div class="graphimg"><img src="{{$fixAssetUrl}}img/stats.png" /></div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="items item2">
						<div class="text1">Total rewards earned</div>
						<div class="text2">$35 752.45</div>
						<div class="graphimg"><img src="{{$fixAssetUrl}}img/stats.png" /></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="dashboard-tier2">
	<div class="table-responsive">
		<table class="table custable">
			<thead>
				<tr>
					<th><span>Node ID</span></th>
					<th><span>Project</span></th>
					<th><span>Node name</span>
						<div class="dropdown nodename">
							<button class="btn btn-default dropdown-toggle" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.94662 0.453369H4.79329H1.05329C0.413288 0.453369 0.0932878 1.2267 0.546621 1.68004L3.99995 5.13337C4.55329 5.6867 5.45329 5.6867 6.00662 5.13337L7.31995 3.82004L9.45995 1.68004C9.90662 1.2267 9.58662 0.453369 8.94662 0.453369Z" fill="#E8EDFF"/></svg>
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdown-currency">
								<li><a href="#"><svg width="3" height="14" viewBox="0 0 3 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.66663 13V1" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg> Sort Ascending</a></li>
								<li><a href="#"><svg width="7" height="4" viewBox="0 0 7 4" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.33325 3L3.33325 1L1.33325 3" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg> Sort Descending</a></li>
								<li><hr /></li>
								<li><a href="#">Hide Column</a></li>
							</ul>
						</div>
					</th>
					<th><span>Own stake</span></th>
					<th><span>Clients stake</span></th>
					<th><span>APY %</span></th>
					<th><span>Earned</span></th>
					<th>
						<div class="dropdown more">
							<button class="btn btn-default dropdown-toggle" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.19 3.05176e-05H5.81C2.17 3.05176e-05 0 2.17003 0 5.81003V14.18C0 17.83 2.17 20 5.81 20H14.18C17.82 20 19.99 17.83 19.99 14.19V5.81003C20 2.17003 17.83 3.05176e-05 14.19 3.05176e-05ZM14 10.75H10.75V14C10.75 14.41 10.41 14.75 10 14.75C9.59 14.75 9.25 14.41 9.25 14V10.75H6C5.59 10.75 5.25 10.41 5.25 10C5.25 9.59003 5.59 9.25003 6 9.25003H9.25V6.00003C9.25 5.59003 9.59 5.25003 10 5.25003C10.41 5.25003 10.75 5.59003 10.75 6.00003V9.25003H14C14.41 9.25003 14.75 9.59003 14.75 10C14.75 10.41 14.41 10.75 14 10.75Z" fill="#A0AEC0"/></svg></button>
							<ul class="dropdown-menu" aria-labelledby="dropdown-currency">
								<li><a href="#">Option 1</a></li>
								<li><a href="#">Option 2</a></li>
							</ul>
						</div>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">All ID</button>
							<ul class="dropdown-menu" aria-labelledby="dropdown-currency">
								<li><a href="#">1</a></li>
							</ul>
						</div>
					</td>
					<td>
						<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Name</button>
							<ul class="dropdown-menu" aria-labelledby="dropdown-currency">
								<li><a href="#">1</a></li>
							</ul>
						</div>
					</td>
					<td>
						<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Node name or wallet</button>
							<ul class="dropdown-menu" aria-labelledby="dropdown-currency">
								<li><a href="#">1</a></li>
							</ul>
						</div>
					</td>
					<td>
						<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">100</button>
							<ul class="dropdown-menu" aria-labelledby="dropdown-currency">
								<li><a href="#">1</a></li>
							</ul>
						</div>
					</td>
					<td>
						<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">30 Days</button>
							<ul class="dropdown-menu" aria-labelledby="dropdown-currency">
								<li><a href="#">1</a></li>
							</ul>
						</div>
					</td>
					<td>
						<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">30 Days</button>
							<ul class="dropdown-menu" aria-labelledby="dropdown-currency">
								<li><a href="#">1</a></li>
							</ul>
						</div>
					</td>
					<td>
						<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">30 Days</button>
							<ul class="dropdown-menu" aria-labelledby="dropdown-currency">
								<li><a href="#">1</a></li>
							</ul>
						</div>
					</td>
					<td></td>
				</tr>
				<tr>
					<td>AAA123456</td>
					<td>Forta</td>
					<td>
						 <div class="table-box-content">
							<div class="img"><img src="{{$fixAssetUrl}}img/logo-icon 1.png" /></div>
							<p class="t-b-c-innert">
								<strong>Node Name123456</strong>
								<span>Forta Forta Forta</span>
							</p>
						 </div>
					</td>
					<td><strong>+$300.00</strong></td>
					<td><strong>+$300.00</strong></td>
					<td><strong>+$300.00</strong></td>
					<td><strong>+$300.00</strong></td>
					<td></td>
				</tr>
				<tr>
					<td>AAA123456</td>
					<td>Forta</td>
					<td>
						 <div class="table-box-content">
							<div class="img"><img src="{{$fixAssetUrl}}img/logo-icon 1.png" /></div>
							<p class="t-b-c-innert">
								<strong>Node Name123456</strong>
								<span>Forta Forta Forta</span>
							</p>
						 </div>
					</td>
					<td><strong>+$300.00</strong></td>
					<td><strong>+$300.00</strong></td>
					<td><strong>+$300.00</strong></td>
					<td><strong>+$300.00</strong></td>
					<td></td>
				</tr>
				<tr>
					<td>AAA123456</td>
					<td>Forta</td>
					<td>
						 <div class="table-box-content">
							<div class="img"><img src="{{$fixAssetUrl}}img/logo-icon 1.png" /></div>
							<p class="t-b-c-innert">
								<strong>Node Name123456</strong>
								<span>Forta Forta Forta</span>
							</p>
						 </div>
					</td>
					<td><strong>+$300.00</strong></td>
					<td><strong>+$300.00</strong></td>
					<td><strong>+$300.00</strong></td>
					<td><strong>+$300.00</strong></td>
					<td></td>
				</tr>
				<tr>
					<td>AAA123456</td>
					<td>Forta</td>
					<td>
						 <div class="table-box-content">
							<div class="img"><img src="{{$fixAssetUrl}}img/logo-icon 1.png" /></div>
							<p class="t-b-c-innert">
								<strong>Node Name123456</strong>
								<span>Forta Forta Forta</span>
							</p>
						 </div>
					</td>
					<td><strong>+$300.00</strong></td>
					<td><strong>+$300.00</strong></td>
					<td><strong>+$300.00</strong></td>
					<td><strong>+$300.00</strong></td>
					<td></td>
				</tr>
				<tr>
					<td>AAA123456</td>
					<td>Forta</td>
					<td>
						 <div class="table-box-content">
							<div class="img"><img src="{{$fixAssetUrl}}img/logo-icon 1.png" /></div>
							<p class="t-b-c-innert">
								<strong>Node Name123456</strong>
								<span>Forta Forta Forta</span>
							</p>
						 </div>
					</td>
					<td><strong>+$300.00</strong></td>
					<td><strong>+$300.00</strong></td>
					<td><strong>+$300.00</strong></td>
					<td><strong>+$300.00</strong></td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="tablefooter">
		<div class="showfilter">
			<span>Show</span>
			<div class="dropdown showfilterdropdown">
				<button class="btn btn-default dropdown-toggle" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">10</button>
				<ul class="dropdown-menu" aria-labelledby="">
					<li><a href="javascript:void(0)">10</a></li>
					<li><a href="javascript:void(0)">20</a></li>
				</ul>
			</div>
		</div>
		<div class="paginations">
			<nav aria-label="Page navigation example">
				<ul class="pagination">
					<li class="page-item"><a class="page-link" href="#">Previous</a></li>
					<li class="page-item"><a class="page-link" href="#">1</a></li>
					<li class="page-item"><a class="page-link" href="#">2</a></li>
					<li class="page-item"><a class="page-link" href="#">3</a></li>
					<li class="page-item"><a class="page-link" href="#">Next</a></li>
				</ul>
			</nav>
		</div>
	</div>
</div>

@endsection