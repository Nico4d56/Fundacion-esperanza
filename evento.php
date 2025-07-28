<?php
class Evento {
    public $descripcion;
    public $tipo;
    public $lugar;
    public $fecha;
    public $hora;

    public function __construct($descripcion, $tipo, $lugar, $fecha, $hora) {
        $this->descripcion = $descripcion;
        $this->tipo = $tipo;
        $this->lugar = $lugar;
        $this->fecha = $fecha;
        $this->hora = $hora;
    }

    public function mostrarEvento() {
        return "<div>
            <h3>{$this->descripcion}</h3>
            <p>Tipo: {$this->tipo}</p>
            <p>Lugar: {$this->lugar}</p>
            <p>Fecha: {$this->fecha}</p>
            <p>Hora: {$this->hora}</p>
        </div>";
    }

    public static function filtrarPorTipo($eventos, $tipoFiltro) {
        return array_filter($eventos, function($evento) use ($tipoFiltro) {
            return strtolower($evento->tipo) == strtolower($tipoFiltro);
        });
    }
}
?>
