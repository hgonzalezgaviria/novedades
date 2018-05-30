@extends('layouts.emails.layout')
@section('title', '- Ticket Cerrado')

@section('tituloMensaje')
  <td class="alert alert-warning" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #2F00FF; margin: 0; padding: 20px;" align="center" bgcolor="#FF9F00" valign="top">
    {{ 'El Ticket ha sido cerrado por G.H'}}
  </td>
@endsection

@section('mensaje')

  <table width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">

    <tr>

    <h1 class="page-header">Ticket No. {{ str_pad($ticket->TICK_ID, 6, '0', STR_PAD_LEFT) }}</h1>

  <div class="jumbotron text-center">
    <strong>Datos Generales</strong>
    <p>
      <ul class="list-group">

        <li class="list-group-item">
          <div class="row">
            <div class="col-lg-4"><strong>Decisión Administrativa:</strong>
            {{ $ticket-> sancion -> SANC_DESCRIPCION }}
            </div>
           
          </div>
        </li>

        <li class="list-group-item">
          <div class="row">
            <div class="col-lg-4"><strong>Observaciones:</strong>
            {{ $ticket-> TICK_CONCLUSION }}
            </div>
           
          </div>
        </li>

        <li class="list-group-item">
          <div class="row">
            <div class="col-lg-4"><strong>Fecha Creación:</strong>
            {{ $ticket->TICK_FECHASOLICITUD }}
            </div>
           
          </div>
        </li>

        <li class="list-group-item">
          <div class="row">
            <div class="col-lg-4"><strong>Empleado:</strong>
            {{ $ticket -> contrato -> prospecto -> nombre_completo }}
            </div>
          </div>
        </li>

        <li class="list-group-item">
          <div class="row">
            <div class="col-lg-4"><strong>Estado:</strong>
            {{ $ticket -> estadoticket -> ESTI_DESCRIPCION }}
            </div>
          </div>
        </li>

        <li class="list-group-item">
          <div class="row">
            <div class="col-lg-4"><strong>Tipo de Incidente:</strong>
            {{ $ticket -> tipoincidente -> TIIN_DESCRIPCION }}
            </div>
          </div>
        </li>

        <li class="list-group-item">
          <div class="row">
            <div class="col-lg-4"><strong>Fecha del Evento:</strong>
            {{ $ticket -> TICK_FECHAEVENTO }}
            </div>
          </div>
        </li>

      </ul>
    </p>

  </div>
        
    </tr>

    <tr>
      ¡El Ticket ha sido cerrado!
    </tr>

     <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
      para ver el detalle del ticket haga click en el enlace <strong style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"> 
      <!-- Botón Ver (show) -->
          <a class="btn btn-small btn-basic btn-xs" href="{{ URL::to('cnfg-tickets/tickets/' . $ticket->TICK_ID  ) }}" data-tooltip="tooltip" title="Ver">
            Ver Ticket
          </a>
      </strong>.
      </td>
    </tr>

    <tr>
      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
      *** esta es una notificación automática, por favor no responder este mensaje *** <strong style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"> 
      <!-- Botón Ver (show) -->
          </a>
      </strong>.
      </td>
    </tr>

  </table>

@endsection