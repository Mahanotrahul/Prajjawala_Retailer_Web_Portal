<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
    <script src="assets/jquery/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            GetCountries();
            GetStates();
            GetCities();
        });
        function GetCountries() {
            $.ajax({
                type: "GET",
                url: "http://api.geonames.org/countryInfoJSON?formatted=true&lang=en&style=full&username=rahulmahanot",
                contentType: "application/json; charset=utf-8",
                dataType: "jsonp",
                success: function (data) {
                    $(".ddlCountry").append($('<option />', { value: -1, text: 'Select Country' }));
                    $(data.geonames).each(function (index, item) {
                        $(".ddlCountry").append($('<option />', { value: item.geonameId, text: item.countryName }));
                    });
                },
                error: function (data) {
                    alert("Failed to get countries.1");
                }
            });
        }

        function GetStates() {
            $(".ddlCountry").change(function () {
                GetChildren($(this).val(), "States", $(".ddlState"));
            });
        }

        function GetCities() {
            $(".ddlState").change(function () {
                GetChildren($(this).val(),"Cities", $(".ddlCity"));
            });
        };

        function GetChildren(geoNameId, childType, ddlSelector) {
            $.ajax({
                type: "GET",
                url: "http://api.geonames.org/childrenJSON?geonameId=" + geoNameId + "&username=rahulmahanot",
                contentType: "application/json; charset=utf-8",
                dataType: "jsonp",
                success: function (data) {
                    $(ddlSelector).empty();
                    $(ddlSelector).append($('<option />', { value: -1, text: 'Select ' + childType }));
                    $(data.geonames).each(function (index, item) {
                        $(ddlSelector).append($('<option />', { value: item.geonameId, text: item.name }));
                    });
                },
                error: function (data) {
                    alert("failed to get data.2");
                }
            });
        }
    </script>
</head>
<body>
    <form id="form1" runat="server">
        <asp:DropDownList
            runat="server"
            ID="ddlCountry"
            CssClass="ddlCountry">
        </asp:DropDownList>
        <br />
        <asp:DropDownList
            runat="server"
            ID="ddlState"
            CssClass="ddlState">
        </asp:DropDownList>
        <br />
        <asp:DropDownList
            runat="server"
            ID="ddlCity"
            CssClass="ddlCity">
        </asp:DropDownList>
    </form>
</body>
</html>