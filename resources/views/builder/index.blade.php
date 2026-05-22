<!DOCTYPE html>
<html>
<head>
    <div id="app">
    <form-builder></form-builder>
</div>

<script type="module" src="{{ mix('js/app.js') }}"></script>

    <title>FormFlow Builder</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/formflow_builder/assets/builder.css">
</head>
<body>
    <h1>FormFlow – Form Builder</h1>

    <div id="builder-container">
        <div id="components-panel">
            <h3>Components</h3>
            <button class="component" data-type="text">Text Input</button>
            <button class="component" data-type="textarea">Textarea</button>
        </div>

        <div id="form-canvas">
            <h3>Form Canvas</h3>
        </div>
    </div>

    <script src="/formflow_builder/assets/builder.js"></script>
</body>
</html>
