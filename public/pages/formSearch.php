<h2 class="center-align">Recherche</h2>
<div class="row">
<nav>
    <div class="nav-wrapper">
        <form>
            <div class="input-field">
                <input id="search" type="search" required>
                <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                <i class="material-icons">close</i>
            </div>
        </form>
    </div>
</nav>
</div> <!--end of row-->

<!-- Switch -->
<div class="switch">
    <label>
        Off
        <input type="checkbox">
        <span class="lever"></span>
        On
    </label>
</div>
<div class="row">
    <form class="col s12">
        <div class="row">
            <div class="input-field col s6">
                <input placeholder="Placeholder" id="first_name" type="text" class="validate">
                <label for="first_name">First Name</label>
            </div>
            <div class="input-field col s6">
                <input id="last_name" type="text" class="validate">
                <label for="last_name">Last Name</label>
            </div>
        </div>
        <div class="row">
        <div class="input-field col s12">
            <label>Materialize Multiple Select</label>
            <select multiple>
                <option value="" disabled selected>Choose your option</option>
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
            </select>

        </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('select').material_select();
    });
    $('select').material_select('destroy');
</script>