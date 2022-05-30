@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">





          <div class="d-flex justify-content-center">


                <div class="card m-2" style="width: 100%">

                    <div class="card-body">
                        <h4>Nouvelle tâche</h4>{{ print_r($day['statut']) }}
                        <form method="POST" action="/tasks/new">
                            @csrf
                        <div class="form-group">
                          <label for="description">Description de la tâche<span style="color: red">*</span> </label>

    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                          <label for="fin">Date de fin de la tâche<span style="color: red">*</span></label>
                          <input type="time" name="fin" class="form-control" id="fin" required>
                        </div>
                        <input name="statut" value=0 hidden>
                        <input name="day_id" value="{{ $day->id }}" hidden>


                        @if (!empty($days) || $day->statut!=0)
                           <button type="submit" class="btn btn-primary">Créer</button>

                        @endif





                      </form>

                      </div>


                  </div>
            </div>


            <div class="row mt-1">
                <div class="col-lg-8 col-sm-12  col-md-12">
                    <div class="card m-2" style="width: 100%">
                        <div class="card-body">


                          @if (empty($tasks)||count($tasks)  <=0)





                          <h5 class="card-title">tâches du - , - - -</h5>


                          <div class="row">
                            <div class="col-12">
                          <div class="card m-2" style="width: 100%">
                            <div class="card-body">
                          <h5 class="card-title">tâches en cours</h5>
                            <div class="text-center">
                                Aucuns tâches
                            </div>


                        </div>
                      </div>
                    </div>



                    <div class="col-12">
                      <div class="card m-2" style="width: 100%">
                        <div class="card-body">
                      <h5 class="card-title">tâches achevées</h5>
                      <div class="text-center">
                        Aucuns tâches
                    </div>

                    </div>
                  </div>
                </div>



                <div class="col-12">
                  <div class="card m-2" style="width: 100%">
                    <div class="card-body">
                  <h5 class="card-title">tâches faites</h5>
                  <div class="text-center">
                    Aucuns tâches
                </div>


                </div>
              </div>
            </div>
                  </div>



                      @else

                      <div class="row">
                          <div class="col-6 col-sm-12 col-md-12">  <h5 class="card-title">tâches du {{ date('l, d M Y',strtotime($day->date) )  }}</h5></div>
                          <div class="col-6 col-sm-12 col-md-12">

                            <div class="">
                                <form method="POST" action="/day/update">

                                    @csrf
                                    <input name="id" value="{{ $day->id }}" hidden/>

                                    @if ($day->satut==0)
                                    <button type="submit" class="btn btn-success">clôturer</button>
                                    @endif

                                </form>


                              </div>
                          </div>
                      </div>




             <div class="row">
                            <div class="col-12">
                          <div class="card m-2" style="width: 100%">
                            <div class="card-body">
                          <h5 class="card-title">tâches en cours</h5>
                          <div class="row">
                            @foreach ($tasks as $ts)

                            @if ($ts->statut == 0)


                            <div class="col-12">
                                <div class="card m-1" style="width: 100%">
                                  <div class="card-body">
                                    <h5 class="card-title">tâche ° {{ $ts->id }}</h5>
                                    <p class="card-text">{{ $ts->description }}</p>

                                    <div class="row">
                                      <div class="col-6">
                                        <div class="text-left">
                                          <p >poster à : {{ date('G:i',strtotime($ts->created_at) )  }}</p>
                                       </div>

                                      </div>
                                      <div class="col-6">
                                        <div class="text-right">
                                          <p >due à : {{  date('G:i',strtotime($ts->fin) ) }}</p>
                                       </div>

                                      </div>
                                    </div>
                                    <div class="text-right">
                                      <form method="POST" action="/tasks/update">
                                          @csrf
                                          <input name="id" value="{{ $ts->id }}" hidden/>

                                          @if ($day->satut==0)
                                          <button type="submit" class="btn btn-success">Terminer</button>
                                          @endif

                                      </form>


                                    </div>

                                  </div>
                                </div>
                              </div>




                            @endif





                            @endforeach

                          </div>


                        </div>
                      </div>
                    </div>



                    <div class="col-12">
                      <div class="card m-2" style="width: 100%">
                        <div class="card-body">
                      <h5 class="card-title">tâches achevées</h5>
                      <div class="row">
                                 @foreach ($tasks as $ts)

                            @if ($ts->statut == 0)


                            <div class="col-12">
                                <div class="card m-1" style="width: 100%">
                                  <div class="card-body">
                                    <h5 class="card-title">tâche ° {{ $ts->id }}</h5>
                                    <p class="card-text">{{ $ts->description }}</p>

                                    <div class="row">
                                      <div class="col-6">
                                        <div class="text-left">
                                          <p >poster à : {{ date('G:i',strtotime($ts->created_at) )  }}</p>
                                       </div>

                                      </div>
                                      <div class="col-6">
                                        <div class="text-right">
                                          <p >due à : {{  date('G:i',strtotime($ts->fin) ) }}</p>
                                       </div>

                                      </div>
                                    </div>


                                  </div>
                                </div>
                              </div>




                            @endif





                            @endforeach
                      </div>


                    </div>
                  </div>
                </div>



                <div class="col-12">
                  <div class="card m-2" style="width: 100%">
                    <div class="card-body">
                  <h5 class="card-title">tâches faites</h5>
                  <div class="row">
                    @foreach ($tasks as $ts)

                    @if ($ts->statut == 1)


                    <div class="col-12">
                        <div class="card m-1" style="width: 100%">
                          <div class="card-body">
                            <h5 class="card-title">tâche ° {{ $ts->id }}</h5>
                            <p class="card-text">{{ $ts->description }}</p>

                            <div class="row">
                              <div class="col-6">
                                <div class="text-left">
                                  <p >poster à : {{ date('G:i',strtotime($ts->created_at) )  }}</p>
                               </div>

                              </div>
                              <div class="col-6">
                                <div class="text-right">
                                  <p >due à : {{  date('G:i',strtotime($ts->fin) ) }}</p>
                               </div>

                              </div>
                            </div>


                          </div>
                        </div>
                      </div>




                    @endif





                    @endforeach
                  </div>


                </div>
              </div>
            </div>
                  </div>




                      @endif

















                        </div>
                      </div>
                </div>
                <div class="col-lg-4  col-sm-12  col-md-12">

                    <div class="card m-2" style="width: 95%">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">



                                    <div class="card " style="width: 100%">

                                        <div class="card-body">
                                            <h4>Nouvelle journée</h4>
                                            <form method="POST" action="/day/new">
                                                @csrf
                                            <div class="form-group" >
                                              <label for="date">Date de la journée<span style="color: red">*</span></label>
                                              <input type="date" name="date" min=<?php echo date("d-m-Y") ?> class="form-control" id="date" required>
                                            </div>
                                            <input name="statut" value=0 hidden>
                                            <input name="nom" value="listes" hidden>

                                            <button type="submit" class="btn btn-primary">Créer</button>
                                          </form>

                                          </div>


                                      </div>


                                </div>
                                <div class="col-12">


                                    <div class="col-12">



                                        <div class="card " style="width: 100% ; border:none">

                                            <div class="card-body mt-3">
                                                <h4>Historique</h4>
                                                        <ul class="list-group list-group-flush">
                                                @if (!empty($days))
                                                @foreach ($days as $dy)

                                                    <form method="POST" action="/day/change" style="border: none">
                                                        @csrf
                                                        <input name="id" value="{{ $dy->id }}" hidden/>
                                                     <li  class="list-group-item" style="border: none" >
                                                        <button type="submit" style="border: none; background:none" class=" ">{{ date('l, d M Y',strtotime($dy->date) )  }}</button>
                                                    </li>
                                                    </form>

                                                @endforeach


                                                  </ul>
                                                  @endif
                                              </div>


                                          </div>


                                    </div>
                                </div>
                            </div>



                        </div>
                      </div>
                </div>
              </div>
    </div>
</div>
@endsection
