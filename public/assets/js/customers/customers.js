var App;
(function (App) {
    var Customers;
    (function (Customers) {
        function ConfirmIdentity() {
            var confirm = prompt();
        }
        Customers.ConfirmIdentity = ConfirmIdentity;
    })(Customers = App.Customers || (App.Customers = {}));
})(App || (App = {}));
//# sourceMappingURL=customers.js.map