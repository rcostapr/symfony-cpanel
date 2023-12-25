/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "./styles/global.scss";
import "./styles/app.css";

require("jquery-ui");
require("jquery-ui/ui/widgets/datepicker");
require("jquery-ui/ui/widgets/accordion");
require("bootstrap");
require("select2");
require("perfect-scrollbar");
require("@fortawesome/fontawesome-free");
import toastr from "toastr";
window.toastr = toastr;
import Swal from "sweetalert2/src/sweetalert2.js";
window.Swal = Swal;
import Dropzone from "dropzone";
window.Dropzone = Swal;

// require jQuery normally
const $ = require("jquery");

// create global $ and jQuery variables
global.$ = global.jQuery = $;
