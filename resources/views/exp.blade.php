<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Custom Select Dropdown</title>
<style>
/* Estilos básicos para el custom select */
.custom-select-wrapper {
  position: relative;
  display: inline-block;
  width: 200px;
}

.custom-select {
  display: none; /* Oculta el select original */
}

.select-selected {
  background-color: #f0f0f0;
  color: #333;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  cursor: pointer;
}

.select-items {
  position: absolute;
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  border-radius: 4px;
  z-index: 99;
  width: 100%;
  max-height: 200px;
  overflow-y: auto;
  display: none;
}

.select-items div {
  color: #333;
  padding: 10px;
  cursor: pointer;
}

.select-items div:hover {
  background-color: #d0d0d0;
}
</style>
</head>
<body>

<div class="filterContainer">
    <div class="filter-group custom-select-wrapper">
        <label for="tipoBebida">Tipo de Bebida:</label>
        <select id="tipoBebida" class="custom-select">
            <option value="">Seleccione</option>
            <option value="agua">Agua</option>
            <option value="soda">Soda</option>
            <option value="gaseosa">Gaseosa</option>
            <option value="cerveza">Cerveza</option>
            <option value="mezclador">Mezclador</option>
            <option value="jugo">Jugo</option>
            <option value="energizante">Energizante</option>
        </select>
        <div class="select-selected">Seleccione</div>
        <div class="select-items">
            <div data-value="agua">Agua</div>
            <div data-value="soda">Soda</div>
            <div data-value="gaseosa">Gaseosa</div>
            <div data-value="cerveza">Cerveza</div>
            <div data-value="mezclador">Mezclador</div>
            <div data-value="jugo">Jugo</div>
            <div data-value="energizante">Energizante</div>
        </div>
    </div>
    <div class="filter-group" id="marcaGroup" style="display:none;">
        <label for="marcaBebida">Marca:</label>
        <select id="marcaBebida" class="my-select">
            <!-- Las opciones se agregarán dinámicamente -->
        </select>
    </div>
</div>

<script>
// JavaScript para manejar la lógica del custom select
document.addEventListener('DOMContentLoaded', () => {
  const selectWrapper = document.querySelector('.custom-select-wrapper');
  const selectElement = selectWrapper.querySelector('.custom-select');
  const selectedElement = selectWrapper.querySelector('.select-selected');
  const itemsContainer = selectWrapper.querySelector('.select-items');
  
  selectedElement.addEventListener('click', () => {
    itemsContainer.style.display = itemsContainer.style.display === 'block' ? 'none' : 'block';
  });
  
  itemsContainer.querySelectorAll('div').forEach(item => {
    item.addEventListener('click', () => {
      selectedElement.textContent = item.textContent;
      selectElement.value = item.getAttribute('data-value');
      itemsContainer.style.display = 'none';
    });
  });
  
  document.addEventListener('click', (event) => {
    if (!selectWrapper.contains(event.target)) {
      itemsContainer.style.display = 'none';
    }
  });
});
</script>

</body>
</html>
