<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <h4 class="card-title">Basic input groups</h4>
        <p class="card-description">
            Basic bootstrap input groups
        </p>
        <div class="form-group">
            <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">@</span>
            </div>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-primary text-white">$</span>
            </div>
            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
            <div class="input-group-append">
                <span class="input-group-text">.00</span>
            </div>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">$</span>
            </div>
            <div class="input-group-prepend">
                <span class="input-group-text">0.00</span>
            </div>
            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
            <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username">
            <div class="input-group-append">
                <button class="btn btn-sm btn-primary" type="button">Search</button>
            </div>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
            <div class="input-group-prepend">
                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</button>
                <div class="dropdown-menu">
                <a class="dropdown-item" href="">Action</a>
                </div>
            </div>
            <input type="text" class="form-control" aria-label="Text input with dropdown button">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
            <input type="text" class="form-control" placeholder="Find in facebook" aria-label="Recipient's username">
            <div class="input-group-append">
                <button class="btn btn-sm btn-facebook" type="button">
                <i class="ti-facebook"></i>
                </button>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <h4 class="card-title">Checkbox Controls</h4>
        <p class="card-description">Checkbox and radio controls (default appearance is in primary color)</p>
        <form>
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">
                    Default
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" checked>
                    Checked
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" disabled>
                    Disabled
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" disabled checked>
                    Disabled checked
                    </label>
                </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="">
                    Default
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2" checked>
                    Selected
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios2" id="optionsRadios3" value="option3" disabled>
                    Disabled
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadio2" id="optionsRadios4" value="option4" disabled checked>
                    Selected and disabled
                    </label>
                </div>
                </div>
            </div>
            </div>
        </form>
        </div>
        <div class="card-body">
        <p class="card-description">Add class <code>.form-check-{color}</code> for checkbox and radio controls in theme colors</p>
        <form>
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <div class="form-check form-check-primary">
                    <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" checked>
                    Primary
                    </label>
                </div>
                <div class="form-check form-check-success">
                    <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" checked>
                    Success
                    </label>
                </div>
                <div class="form-check form-check-info">
                    <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" checked>
                    Info
                    </label>
                </div>
                <div class="form-check form-check-danger">
                    <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" checked>
                    Danger
                    </label>
                </div>
                <div class="form-check form-check-warning">
                    <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" checked>
                    Warning
                    </label>
                </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <div class="form-check form-check-primary">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="ExampleRadio1" id="ExampleRadio1" checked>
                    Primary
                    </label>
                </div>
                <div class="form-check form-check-success">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="ExampleRadio2" id="ExampleRadio2" checked>
                    Success
                    </label>
                </div>
                <div class="form-check form-check-info">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="ExampleRadio3" id="ExampleRadio3" checked>
                    Info
                    </label>
                </div>
                <div class="form-check form-check-danger">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="ExampleRadio4" id="ExampleRadio4" checked>
                    Danger
                    </label>
                </div>
                <div class="form-check form-check-warning">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="ExampleRadio5" id="ExampleRadio5" checked>
                    Warning
                    </label>
                </div>
                </div>
            </div>
            </div>
        </form>
        </div>
    </div>
</div>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <h4 class="card-title">Inline forms</h4>
        <p class="card-description">
            Use the <code>.form-inline</code> class to display a series of labels, form controls, and buttons on a single horizontal row
        </p>
        <form class="form-inline">
            <label class="sr-only" for="inlineFormInputName2">Name</label>
            <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Jane Doe">
        
            <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
            <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text">@</div>
            </div>
            <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username">
            </div>
            <div class="form-check mx-sm-2">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" checked>
                Remember me
            </label>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </form>
        </div>
    </div>
</div>