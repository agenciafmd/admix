@extends('agenciafmd/admix::master')

@section('content')
{{--    <div class="col-md-6 col-lg-12">--}}
{{--        <div class="row">--}}
{{--            <div class="col-sm-6 col-lg-3">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="card-value float-right text-blue">+5%</div>--}}
{{--                        <h3 class="mb-1">423</h3>--}}
{{--                        <div class="text-muted">Users online</div>--}}
{{--                    </div>--}}
{{--                    <div class="card-chart-bg">--}}
{{--                        <div id="chart-bg-users-1" style="height: 100%"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <script>--}}
{{--                    $(document).ready(function() {--}}
{{--                        var chart = c3.generate({--}}
{{--                            bindto: '#chart-bg-users-1',--}}
{{--                            padding: {--}}
{{--                                bottom: -10,--}}
{{--                                left: -1,--}}
{{--                                right: -1--}}
{{--                            },--}}
{{--                            data: {--}}
{{--                                names: {--}}
{{--                                    data1: 'Users online'--}}
{{--                                },--}}
{{--                                columns: [--}}
{{--                                    ['data1', 30, 40, 10, 40, 12, 22, 40]--}}
{{--                                ],--}}
{{--                                type: 'area'--}}
{{--                            },--}}
{{--                            legend: {--}}
{{--                                show: false--}}
{{--                            },--}}
{{--                            transition: {--}}
{{--                                duration: 0--}}
{{--                            },--}}
{{--                            point: {--}}
{{--                                show: false--}}
{{--                            },--}}
{{--                            tooltip: {--}}
{{--                                format: {--}}
{{--                                    title: function (x) {--}}
{{--                                        return '';--}}
{{--                                    }--}}
{{--                                }--}}
{{--                            },--}}
{{--                            axis: {--}}
{{--                                y: {--}}
{{--                                    padding: {--}}
{{--                                        bottom: 0,--}}
{{--                                    },--}}
{{--                                    show: false,--}}
{{--                                    tick: {--}}
{{--                                        outer: false--}}
{{--                                    }--}}
{{--                                },--}}
{{--                                x: {--}}
{{--                                    padding: {--}}
{{--                                        left: 0,--}}
{{--                                        right: 0--}}
{{--                                    },--}}
{{--                                    show: false--}}
{{--                                }--}}
{{--                            },--}}
{{--                            color: {--}}
{{--                                pattern: ['#467fcf']--}}
{{--                            }--}}
{{--                        });--}}
{{--                    });--}}
{{--                </script>--}}
{{--            </div>--}}
{{--            <div class="col-sm-6 col-lg-3">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="card-value float-right text-red">-3%</div>--}}
{{--                        <h3 class="mb-1">423</h3>--}}
{{--                        <div class="text-muted">Users online</div>--}}
{{--                    </div>--}}
{{--                    <div class="card-chart-bg">--}}
{{--                        <div id="chart-bg-users-2" style="height: 100%; max-height: 64px; position: relative;" class="c3"><svg width="274" height="64" style="overflow: hidden;"><defs><clipPath id="c3-1564536960224-clip"><rect width="275" height="62"></rect></clipPath><clipPath id="c3-1564536960224-clip-xaxis"><rect x="-31" y="-20" width="337" height="18"></rect></clipPath><clipPath id="c3-1564536960224-clip-yaxis"><rect x="-29" y="-4" width="19" height="86"></rect></clipPath><clipPath id="c3-1564536960224-clip-grid"><rect width="275" height="62"></rect></clipPath><clipPath id="c3-1564536960224-clip-subchart"><rect width="275"></rect></clipPath></defs><g transform="translate(-0.5,4.5)"><text class="c3-text c3-empty" text-anchor="middle" dominant-baseline="middle" x="137.5" y="31" style="opacity: 0;"></text><rect class="c3-zoom-rect" width="275" height="62" style="opacity: 0;"></rect><g clip-path="url(https://preview.tabler.io/#c3-1564536960224-clip)" class="c3-regions" style="visibility: visible;"></g><g clip-path="url(https://preview.tabler.io/#c3-1564536960224-clip-grid)" class="c3-grid" style="visibility: visible;"><g class="c3-xgrid-focus"><line class="c3-xgrid-focus" x1="46" x2="46" y1="0" y2="62" style="visibility: hidden;"></line></g></g><g clip-path="url(https://preview.tabler.io/#c3-1564536960224-clip)" class="c3-chart"><g class="c3-event-rects c3-event-rects-single" style="fill-opacity: 0;"><rect class=" c3-event-rect c3-event-rect-0" x="-19.642857142857142" y="0" width="39.285714285714285" height="62"></rect><rect class=" c3-event-rect c3-event-rect-1" x="26.357142857142858" y="0" width="39.285714285714285" height="62"></rect><rect class=" c3-event-rect c3-event-rect-2" x="72.35714285714286" y="0" width="39.285714285714285" height="62"></rect><rect class=" c3-event-rect c3-event-rect-3" x="118.35714285714286" y="0" width="39.285714285714285" height="62"></rect><rect class=" c3-event-rect c3-event-rect-4" x="164.35714285714286" y="0" width="39.285714285714285" height="62"></rect><rect class=" c3-event-rect c3-event-rect-5" x="210.35714285714286" y="0" width="39.285714285714285" height="62"></rect><rect class=" c3-event-rect c3-event-rect-6" x="255.35714285714286" y="0" width="39.285714285714285" height="62"></rect></g><g class="c3-chart-bars"><g class="c3-chart-bar c3-target c3-target-data1" style="pointer-events: none;"><g class=" c3-shapes c3-shapes-data1 c3-bars c3-bars-data1" style="cursor: pointer;"></g></g></g><g class="c3-chart-lines"><g class="c3-chart-line c3-target c3-target-data1" style="opacity: 1; pointer-events: none;"><g class=" c3-shapes c3-shapes-data1 c3-lines c3-lines-data1"><path class=" c3-shape c3-shape c3-line c3-line-data1" d="M0,20.409090909090914L46,6.545454545454548L92,48.13636363636363L138,6.545454545454548L184,45.36363636363637L230,31.5L275,6.545454545454548" style="stroke: rgb(231, 76, 60); opacity: 1;"></path></g><g class=" c3-shapes c3-shapes-data1 c3-areas c3-areas-data1"><path class=" c3-shape c3-shape c3-area c3-area-data1" d="M0,20.409090909090914L46,6.545454545454548L92,48.13636363636363L138,6.545454545454548L184,45.36363636363637L230,31.5L275,6.545454545454548L275,62L230,62L184,62L138,62L92,62L46,62L0,62Z" style="fill: rgb(231, 76, 60); opacity: 0.1;"></path></g><g class=" c3-selected-circles c3-selected-circles-data1"></g><g class=" c3-shapes c3-shapes-data1 c3-circles c3-circles-data1" style="cursor: pointer;"><circle class=" c3-shape c3-shape-0 c3-circle c3-circle-0" r="2.5" style="fill: rgb(231, 76, 60); opacity: 0;" cx="0" cy="20.409090909090914"></circle><circle class="c3-shape c3-shape-1 c3-circle c3-circle-1" r="2.5" style="fill: rgb(231, 76, 60); opacity: 0;" cx="46" cy="6.545454545454548"></circle><circle class="c3-shape c3-shape-2 c3-circle c3-circle-2" r="2.5" style="fill: rgb(231, 76, 60); opacity: 0;" cx="92" cy="48.13636363636363"></circle><circle class=" c3-shape c3-shape-3 c3-circle c3-circle-3" r="2.5" style="fill: rgb(231, 76, 60); opacity: 0;" cx="138" cy="6.545454545454548"></circle><circle class=" c3-shape c3-shape-4 c3-circle c3-circle-4" r="2.5" style="fill: rgb(231, 76, 60); opacity: 0;" cx="184" cy="45.36363636363637"></circle><circle class="c3-shape c3-shape-5 c3-circle c3-circle-5" r="2.5" style="fill: rgb(231, 76, 60); opacity: 0;" cx="230" cy="31.5"></circle><circle class=" c3-shape c3-shape-6 c3-circle c3-circle-6" r="2.5" style="fill: rgb(231, 76, 60); opacity: 0;" cx="275" cy="6.545454545454548"></circle></g></g></g><g class="c3-chart-arcs" transform="translate(137.5,26)"><text class="c3-chart-arcs-title" style="text-anchor: middle; opacity: 0;"></text></g><g class="c3-chart-texts"><g class="c3-chart-text c3-target c3-target-data1" style="opacity: 1; pointer-events: none;"><g class=" c3-texts c3-texts-data1"></g></g></g></g><g clip-path="url(https://preview.tabler.io/#c3-1564536960224-clip-grid)" class="c3-grid c3-grid-lines"><g class="c3-xgrid-lines"></g><g class="c3-ygrid-lines"></g></g><g class="c3-axis c3-axis-x" clip-path="url(https://preview.tabler.io/#c3-1564536960224-clip-xaxis)" transform="translate(0,62)" style="visibility: hidden; opacity: 1;"><text class="c3-axis-x-label" transform="" style="text-anchor: end;" x="275" dx="-0.5em" dy="-0.5em"></text><g class="tick" transform="translate(0, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="0"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">0</tspan></text></g><g class="tick" transform="translate(46, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">1</tspan></text></g><g class="tick" transform="translate(92, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">2</tspan></text></g><g class="tick" transform="translate(138, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">3</tspan></text></g><g class="tick" transform="translate(184, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">4</tspan></text></g><g class="tick" transform="translate(230, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">5</tspan></text></g><g class="tick" transform="translate(275, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="0"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">6</tspan></text></g><path class="domain" d="M0,6V0H275V6"></path></g><g class="c3-axis c3-axis-y" clip-path="url(https://preview.tabler.io/#c3-1564536960224-clip-yaxis)" transform="translate(0,0)" style="visibility: hidden; opacity: 1;"><text class="c3-axis-y-label" transform="rotate(-90)" style="text-anchor: end;" x="0" dx="-0.5em" dy="1.2em"></text><g class="tick" style="opacity: 1;" transform="translate(0,62)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">0</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,56)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">5</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,49)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">10</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,42)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">15</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,35)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">20</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,28)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">25</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,21)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">30</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,14)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">35</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,7)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">40</tspan></text></g><path class="domain" d="M0,1H0V62H0"></path></g><g class="c3-axis c3-axis-y2" transform="translate(275,0)" style="visibility: hidden; opacity: 1;"><text class="c3-axis-y2-label" transform="rotate(-90)" style="text-anchor: end;" x="0" dx="-0.5em" dy="-0.5em"></text><g class="tick" transform="translate(0,62)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0</tspan></text></g><g class="tick" transform="translate(0,56)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.1</tspan></text></g><g class="tick" transform="translate(0,50)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.2</tspan></text></g><g class="tick" transform="translate(0,44)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.3</tspan></text></g><g class="tick" transform="translate(0,38)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.4</tspan></text></g><g class="tick" transform="translate(0,32)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.5</tspan></text></g><g class="tick" transform="translate(0,26)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.6</tspan></text></g><g class="tick" transform="translate(0,20)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.7</tspan></text></g><g class="tick" transform="translate(0,14)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.8</tspan></text></g><g class="tick" transform="translate(0,8)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.9</tspan></text></g><g class="tick" transform="translate(0,1)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">1</tspan></text></g><path class="domain" d="M6,1H0V62H6"></path></g></g><g transform="translate(-0.5,64.5)" style="visibility: hidden;"><g clip-path="url(https://preview.tabler.io/#c3-1564536960224-clip-subchart)" class="c3-chart"><g class="c3-chart-bars"></g><g class="c3-chart-lines"></g></g><g clip-path="url(https://preview.tabler.io/#c3-1564536960224-clip)" class="c3-brush" style="pointer-events: all; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><rect class="background" x="0" width="275" style="visibility: hidden; cursor: crosshair;"></rect><rect class="extent" x="0" width="0" style="cursor: move;"></rect><g class="resize e" transform="translate(0,0)" style="cursor: ew-resize; display: none;"><rect x="-3" width="6" height="6" style="visibility: hidden;"></rect></g><g class="resize w" transform="translate(0,0)" style="cursor: ew-resize; display: none;"><rect x="-3" width="6" height="6" style="visibility: hidden;"></rect></g></g><g class="c3-axis-x" transform="translate(0,0)" clip-path="url(https://preview.tabler.io/#c3-1564536960224-clip-xaxis)" style="visibility: hidden; opacity: 1;"><g class="tick" transform="translate(0, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="0"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">0</tspan></text></g><g class="tick" transform="translate(46, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">1</tspan></text></g><g class="tick" transform="translate(92, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">2</tspan></text></g><g class="tick" transform="translate(138, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">3</tspan></text></g><g class="tick" transform="translate(184, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">4</tspan></text></g><g class="tick" transform="translate(230, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">5</tspan></text></g><g class="tick" transform="translate(275, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="0"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">6</tspan></text></g><path class="domain" d="M0,6V0H275V6"></path></g></g><g transform="translate(0,64)" style="visibility: hidden;"></g><text class="c3-title" x="137" y="0"></text></svg><div class="c3-tooltip-container" style="position: absolute; pointer-events: none; display: none; top: 17.25px; left: 65.5px;"><table class="c3-tooltip"><tbody><tr class="c3-tooltip-name--data1"><td class="name"><span style="background-color:#e74c3c"></span>Users online</td><td class="value">40</td></tr></tbody></table></div></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <script>--}}

{{--                        $(document).ready(function() {--}}
{{--                            var chart = c3.generate({--}}
{{--                                bindto: '#chart-bg-users-2',--}}
{{--                                padding: {--}}
{{--                                    bottom: -10,--}}
{{--                                    left: -1,--}}
{{--                                    right: -1--}}
{{--                                },--}}
{{--                                data: {--}}
{{--                                    names: {--}}
{{--                                        data1: 'Users online'--}}
{{--                                    },--}}
{{--                                    columns: [--}}
{{--                                        ['data1', 30, 40, 10, 40, 12, 22, 40]--}}
{{--                                    ],--}}
{{--                                    type: 'area'--}}
{{--                                },--}}
{{--                                legend: {--}}
{{--                                    show: false--}}
{{--                                },--}}
{{--                                transition: {--}}
{{--                                    duration: 0--}}
{{--                                },--}}
{{--                                point: {--}}
{{--                                    show: false--}}
{{--                                },--}}
{{--                                tooltip: {--}}
{{--                                    format: {--}}
{{--                                        title: function (x) {--}}
{{--                                            return '';--}}
{{--                                        }--}}
{{--                                    }--}}
{{--                                },--}}
{{--                                axis: {--}}
{{--                                    y: {--}}
{{--                                        padding: {--}}
{{--                                            bottom: 0,--}}
{{--                                        },--}}
{{--                                        show: false,--}}
{{--                                        tick: {--}}
{{--                                            outer: false--}}
{{--                                        }--}}
{{--                                    },--}}
{{--                                    x: {--}}
{{--                                        padding: {--}}
{{--                                            left: 0,--}}
{{--                                            right: 0--}}
{{--                                        },--}}
{{--                                        show: false--}}
{{--                                    }--}}
{{--                                },--}}
{{--                                color: {--}}
{{--                                    pattern: ['#e74c3c']--}}
{{--                                }--}}
{{--                            });--}}
{{--                        });--}}
{{--                </script>--}}
{{--            </div>--}}
{{--            <div class="col-sm-6 col-lg-3">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="card-value float-right text-green">-3%</div>--}}
{{--                        <h3 class="mb-1">423</h3>--}}
{{--                        <div class="text-muted">Users online</div>--}}
{{--                    </div>--}}
{{--                    <div class="card-chart-bg">--}}
{{--                        <div id="chart-bg-users-3" style="height: 100%; max-height: 64px; position: relative;" class="c3"><svg width="274" height="64" style="overflow: hidden;"><defs><clipPath id="c3-1564536960259-clip"><rect width="275" height="62"></rect></clipPath><clipPath id="c3-1564536960259-clip-xaxis"><rect x="-31" y="-20" width="337" height="18"></rect></clipPath><clipPath id="c3-1564536960259-clip-yaxis"><rect x="-29" y="-4" width="19" height="86"></rect></clipPath><clipPath id="c3-1564536960259-clip-grid"><rect width="275" height="62"></rect></clipPath><clipPath id="c3-1564536960259-clip-subchart"><rect width="275"></rect></clipPath></defs><g transform="translate(-0.5,4.5)"><text class="c3-text c3-empty" text-anchor="middle" dominant-baseline="middle" x="137.5" y="31" style="opacity: 0;"></text><rect class="c3-zoom-rect" width="275" height="62" style="opacity: 0;"></rect><g clip-path="url(https://preview.tabler.io/#c3-1564536960259-clip)" class="c3-regions" style="visibility: visible;"></g><g clip-path="url(https://preview.tabler.io/#c3-1564536960259-clip-grid)" class="c3-grid" style="visibility: visible;"><g class="c3-xgrid-focus"><line class="c3-xgrid-focus" x1="-10" x2="-10" y1="0" y2="62" style="visibility: hidden;"></line></g></g><g clip-path="url(https://preview.tabler.io/#c3-1564536960259-clip)" class="c3-chart"><g class="c3-event-rects c3-event-rects-single" style="fill-opacity: 0;"><rect class=" c3-event-rect c3-event-rect-0" x="-19.642857142857142" y="0" width="39.285714285714285" height="62"></rect><rect class=" c3-event-rect c3-event-rect-1" x="26.357142857142858" y="0" width="39.285714285714285" height="62"></rect><rect class=" c3-event-rect c3-event-rect-2" x="72.35714285714286" y="0" width="39.285714285714285" height="62"></rect><rect class=" c3-event-rect c3-event-rect-3" x="118.35714285714286" y="0" width="39.285714285714285" height="62"></rect><rect class=" c3-event-rect c3-event-rect-4" x="164.35714285714286" y="0" width="39.285714285714285" height="62"></rect><rect class=" c3-event-rect c3-event-rect-5" x="210.35714285714286" y="0" width="39.285714285714285" height="62"></rect><rect class=" c3-event-rect c3-event-rect-6" x="255.35714285714286" y="0" width="39.285714285714285" height="62"></rect></g><g class="c3-chart-bars"><g class="c3-chart-bar c3-target c3-target-data1" style="pointer-events: none;"><g class=" c3-shapes c3-shapes-data1 c3-bars c3-bars-data1" style="cursor: pointer;"></g></g></g><g class="c3-chart-lines"><g class="c3-chart-line c3-target c3-target-data1" style="opacity: 1; pointer-events: none;"><g class=" c3-shapes c3-shapes-data1 c3-lines c3-lines-data1"><path class=" c3-shape c3-shape c3-line c3-line-data1" d="M0,20.409090909090914L46,6.545454545454548L92,48.13636363636363L138,6.545454545454548L184,45.36363636363637L230,31.5L275,6.545454545454548" style="stroke: rgb(94, 186, 0); opacity: 1;"></path></g><g class=" c3-shapes c3-shapes-data1 c3-areas c3-areas-data1"><path class=" c3-shape c3-shape c3-area c3-area-data1" d="M0,20.409090909090914L46,6.545454545454548L92,48.13636363636363L138,6.545454545454548L184,45.36363636363637L230,31.5L275,6.545454545454548L275,62L230,62L184,62L138,62L92,62L46,62L0,62Z" style="fill: rgb(94, 186, 0); opacity: 0.1;"></path></g><g class=" c3-selected-circles c3-selected-circles-data1"></g><g class=" c3-shapes c3-shapes-data1 c3-circles c3-circles-data1" style="cursor: pointer;"><circle class=" c3-shape c3-shape-0 c3-circle c3-circle-0" r="2.5" style="fill: rgb(94, 186, 0); opacity: 0;" cx="0" cy="20.409090909090914"></circle><circle class=" c3-shape c3-shape-1 c3-circle c3-circle-1" r="2.5" style="fill: rgb(94, 186, 0); opacity: 0;" cx="46" cy="6.545454545454548"></circle><circle class=" c3-shape c3-shape-2 c3-circle c3-circle-2" r="2.5" style="fill: rgb(94, 186, 0); opacity: 0;" cx="92" cy="48.13636363636363"></circle><circle class=" c3-shape c3-shape-3 c3-circle c3-circle-3" r="2.5" style="fill: rgb(94, 186, 0); opacity: 0;" cx="138" cy="6.545454545454548"></circle><circle class=" c3-shape c3-shape-4 c3-circle c3-circle-4" r="2.5" style="fill: rgb(94, 186, 0); opacity: 0;" cx="184" cy="45.36363636363637"></circle><circle class="c3-shape c3-shape-5 c3-circle c3-circle-5" r="2.5" style="fill: rgb(94, 186, 0); opacity: 0;" cx="230" cy="31.5"></circle><circle class=" c3-shape c3-shape-6 c3-circle c3-circle-6" r="2.5" style="fill: rgb(94, 186, 0); opacity: 0;" cx="275" cy="6.545454545454548"></circle></g></g></g><g class="c3-chart-arcs" transform="translate(137.5,26)"><text class="c3-chart-arcs-title" style="text-anchor: middle; opacity: 0;"></text></g><g class="c3-chart-texts"><g class="c3-chart-text c3-target c3-target-data1" style="opacity: 1; pointer-events: none;"><g class=" c3-texts c3-texts-data1"></g></g></g></g><g clip-path="url(https://preview.tabler.io/#c3-1564536960259-clip-grid)" class="c3-grid c3-grid-lines"><g class="c3-xgrid-lines"></g><g class="c3-ygrid-lines"></g></g><g class="c3-axis c3-axis-x" clip-path="url(https://preview.tabler.io/#c3-1564536960259-clip-xaxis)" transform="translate(0,62)" style="visibility: hidden; opacity: 1;"><text class="c3-axis-x-label" transform="" style="text-anchor: end;" x="275" dx="-0.5em" dy="-0.5em"></text><g class="tick" transform="translate(0, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="0"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">0</tspan></text></g><g class="tick" transform="translate(46, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">1</tspan></text></g><g class="tick" transform="translate(92, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">2</tspan></text></g><g class="tick" transform="translate(138, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">3</tspan></text></g><g class="tick" transform="translate(184, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">4</tspan></text></g><g class="tick" transform="translate(230, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">5</tspan></text></g><g class="tick" transform="translate(275, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="0"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">6</tspan></text></g><path class="domain" d="M0,6V0H275V6"></path></g><g class="c3-axis c3-axis-y" clip-path="url(https://preview.tabler.io/#c3-1564536960259-clip-yaxis)" transform="translate(0,0)" style="visibility: hidden; opacity: 1;"><text class="c3-axis-y-label" transform="rotate(-90)" style="text-anchor: end;" x="0" dx="-0.5em" dy="1.2em"></text><g class="tick" style="opacity: 1;" transform="translate(0,62)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">0</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,56)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">5</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,49)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">10</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,42)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">15</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,35)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">20</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,28)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">25</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,21)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">30</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,14)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">35</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,7)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">40</tspan></text></g><path class="domain" d="M0,1H0V62H0"></path></g><g class="c3-axis c3-axis-y2" transform="translate(275,0)" style="visibility: hidden; opacity: 1;"><text class="c3-axis-y2-label" transform="rotate(-90)" style="text-anchor: end;" x="0" dx="-0.5em" dy="-0.5em"></text><g class="tick" transform="translate(0,62)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0</tspan></text></g><g class="tick" transform="translate(0,56)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.1</tspan></text></g><g class="tick" transform="translate(0,50)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.2</tspan></text></g><g class="tick" transform="translate(0,44)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.3</tspan></text></g><g class="tick" transform="translate(0,38)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.4</tspan></text></g><g class="tick" transform="translate(0,32)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.5</tspan></text></g><g class="tick" transform="translate(0,26)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.6</tspan></text></g><g class="tick" transform="translate(0,20)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.7</tspan></text></g><g class="tick" transform="translate(0,14)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.8</tspan></text></g><g class="tick" transform="translate(0,8)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.9</tspan></text></g><g class="tick" transform="translate(0,1)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">1</tspan></text></g><path class="domain" d="M6,1H0V62H6"></path></g></g><g transform="translate(-0.5,64.5)" style="visibility: hidden;"><g clip-path="url(https://preview.tabler.io/#c3-1564536960259-clip-subchart)" class="c3-chart"><g class="c3-chart-bars"></g><g class="c3-chart-lines"></g></g><g clip-path="url(https://preview.tabler.io/#c3-1564536960259-clip)" class="c3-brush" style="pointer-events: all; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><rect class="background" x="0" width="275" style="visibility: hidden; cursor: crosshair;"></rect><rect class="extent" x="0" width="0" style="cursor: move;"></rect><g class="resize e" transform="translate(0,0)" style="cursor: ew-resize; display: none;"><rect x="-3" width="6" height="6" style="visibility: hidden;"></rect></g><g class="resize w" transform="translate(0,0)" style="cursor: ew-resize; display: none;"><rect x="-3" width="6" height="6" style="visibility: hidden;"></rect></g></g><g class="c3-axis-x" transform="translate(0,0)" clip-path="url(https://preview.tabler.io/#c3-1564536960259-clip-xaxis)" style="visibility: hidden; opacity: 1;"><g class="tick" transform="translate(0, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="0"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">0</tspan></text></g><g class="tick" transform="translate(46, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">1</tspan></text></g><g class="tick" transform="translate(92, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">2</tspan></text></g><g class="tick" transform="translate(138, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">3</tspan></text></g><g class="tick" transform="translate(184, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">4</tspan></text></g><g class="tick" transform="translate(230, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">5</tspan></text></g><g class="tick" transform="translate(275, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="0"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">6</tspan></text></g><path class="domain" d="M0,6V0H275V6"></path></g></g><g transform="translate(0,64)" style="visibility: hidden;"></g><text class="c3-title" x="137" y="0"></text></svg><div class="c3-tooltip-container" style="position: absolute; pointer-events: none; display: none; top: 38.25px; left: 146.5px;"><table class="c3-tooltip"><tbody><tr class="c3-tooltip-name--data1"><td class="name"><span style="background-color:#5eba00"></span>Users online</td><td class="value">22</td></tr></tbody></table></div></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <script>--}}

{{--                        $(document).ready(function() {--}}
{{--                            var chart = c3.generate({--}}
{{--                                bindto: '#chart-bg-users-3',--}}
{{--                                padding: {--}}
{{--                                    bottom: -10,--}}
{{--                                    left: -1,--}}
{{--                                    right: -1--}}
{{--                                },--}}
{{--                                data: {--}}
{{--                                    names: {--}}
{{--                                        data1: 'Users online'--}}
{{--                                    },--}}
{{--                                    columns: [--}}
{{--                                        ['data1', 30, 40, 10, 40, 12, 22, 40]--}}
{{--                                    ],--}}
{{--                                    type: 'area'--}}
{{--                                },--}}
{{--                                legend: {--}}
{{--                                    show: false--}}
{{--                                },--}}
{{--                                transition: {--}}
{{--                                    duration: 0--}}
{{--                                },--}}
{{--                                point: {--}}
{{--                                    show: false--}}
{{--                                },--}}
{{--                                tooltip: {--}}
{{--                                    format: {--}}
{{--                                        title: function (x) {--}}
{{--                                            return '';--}}
{{--                                        }--}}
{{--                                    }--}}
{{--                                },--}}
{{--                                axis: {--}}
{{--                                    y: {--}}
{{--                                        padding: {--}}
{{--                                            bottom: 0,--}}
{{--                                        },--}}
{{--                                        show: false,--}}
{{--                                        tick: {--}}
{{--                                            outer: false--}}
{{--                                        }--}}
{{--                                    },--}}
{{--                                    x: {--}}
{{--                                        padding: {--}}
{{--                                            left: 0,--}}
{{--                                            right: 0--}}
{{--                                        },--}}
{{--                                        show: false--}}
{{--                                    }--}}
{{--                                },--}}
{{--                                color: {--}}
{{--                                    pattern: ['#5eba00']--}}
{{--                                }--}}
{{--                            });--}}
{{--                        });--}}
{{--                </script>--}}
{{--            </div>--}}
{{--            <div class="col-sm-6 col-lg-3">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="card-value float-right text-yellow">9%</div>--}}
{{--                        <h3 class="mb-1">423</h3>--}}
{{--                        <div class="text-muted">Users online</div>--}}
{{--                    </div>--}}
{{--                    <div class="card-chart-bg">--}}
{{--                        <div id="chart-bg-users-4" style="height: 100%; max-height: 64px; position: relative;" class="c3"><svg width="274" height="64" style="overflow: hidden;"><defs><clipPath id="c3-1564536960305-clip"><rect width="275" height="62"></rect></clipPath><clipPath id="c3-1564536960305-clip-xaxis"><rect x="-31" y="-20" width="337" height="18"></rect></clipPath><clipPath id="c3-1564536960305-clip-yaxis"><rect x="-29" y="-4" width="19" height="86"></rect></clipPath><clipPath id="c3-1564536960305-clip-grid"><rect width="275" height="62"></rect></clipPath><clipPath id="c3-1564536960305-clip-subchart"><rect width="275"></rect></clipPath></defs><g transform="translate(-0.5,4.5)"><text class="c3-text c3-empty" text-anchor="middle" dominant-baseline="middle" x="137.5" y="31" style="opacity: 0;"></text><rect class="c3-zoom-rect" width="275" height="62" style="opacity: 0;"></rect><g clip-path="url(https://preview.tabler.io/#c3-1564536960305-clip)" class="c3-regions" style="visibility: visible;"></g><g clip-path="url(https://preview.tabler.io/#c3-1564536960305-clip-grid)" class="c3-grid" style="visibility: visible;"><g class="c3-xgrid-focus"><line class="c3-xgrid-focus" x1="-10" x2="-10" y1="0" y2="62" style="visibility: hidden;"></line></g></g><g clip-path="url(https://preview.tabler.io/#c3-1564536960305-clip)" class="c3-chart"><g class="c3-event-rects c3-event-rects-single" style="fill-opacity: 0;"><rect class=" c3-event-rect c3-event-rect-0" x="-19.642857142857142" y="0" width="39.285714285714285" height="62"></rect><rect class=" c3-event-rect c3-event-rect-1" x="26.357142857142858" y="0" width="39.285714285714285" height="62"></rect><rect class=" c3-event-rect c3-event-rect-2" x="72.35714285714286" y="0" width="39.285714285714285" height="62"></rect><rect class=" c3-event-rect c3-event-rect-3" x="118.35714285714286" y="0" width="39.285714285714285" height="62"></rect><rect class=" c3-event-rect c3-event-rect-4" x="164.35714285714286" y="0" width="39.285714285714285" height="62"></rect><rect class=" c3-event-rect c3-event-rect-5" x="210.35714285714286" y="0" width="39.285714285714285" height="62"></rect><rect class=" c3-event-rect c3-event-rect-6" x="255.35714285714286" y="0" width="39.285714285714285" height="62"></rect></g><g class="c3-chart-bars"><g class="c3-chart-bar c3-target c3-target-data1" style="pointer-events: none;"><g class=" c3-shapes c3-shapes-data1 c3-bars c3-bars-data1" style="cursor: pointer;"></g></g></g><g class="c3-chart-lines"><g class="c3-chart-line c3-target c3-target-data1" style="opacity: 1; pointer-events: none;"><g class=" c3-shapes c3-shapes-data1 c3-lines c3-lines-data1"><path class=" c3-shape c3-shape c3-line c3-line-data1" d="M0,20.409090909090914L46,6.545454545454548L92,48.13636363636363L138,6.545454545454548L184,45.36363636363637L230,31.5L275,6.545454545454548" style="stroke: rgb(241, 196, 15); opacity: 1;"></path></g><g class=" c3-shapes c3-shapes-data1 c3-areas c3-areas-data1"><path class=" c3-shape c3-shape c3-area c3-area-data1" d="M0,20.409090909090914L46,6.545454545454548L92,48.13636363636363L138,6.545454545454548L184,45.36363636363637L230,31.5L275,6.545454545454548L275,62L230,62L184,62L138,62L92,62L46,62L0,62Z" style="fill: rgb(241, 196, 15); opacity: 0.1;"></path></g><g class=" c3-selected-circles c3-selected-circles-data1"></g><g class=" c3-shapes c3-shapes-data1 c3-circles c3-circles-data1" style="cursor: pointer;"><circle class="c3-shape c3-shape-0 c3-circle c3-circle-0" r="2.5" style="fill: rgb(241, 196, 15); opacity: 0;" cx="0" cy="20.409090909090914"></circle><circle class=" c3-shape c3-shape-1 c3-circle c3-circle-1" r="2.5" style="fill: rgb(241, 196, 15); opacity: 0;" cx="46" cy="6.545454545454548"></circle><circle class=" c3-shape c3-shape-2 c3-circle c3-circle-2" r="2.5" style="fill: rgb(241, 196, 15); opacity: 0;" cx="92" cy="48.13636363636363"></circle><circle class=" c3-shape c3-shape-3 c3-circle c3-circle-3" r="2.5" style="fill: rgb(241, 196, 15); opacity: 0;" cx="138" cy="6.545454545454548"></circle><circle class=" c3-shape c3-shape-4 c3-circle c3-circle-4" r="2.5" style="fill: rgb(241, 196, 15); opacity: 0;" cx="184" cy="45.36363636363637"></circle><circle class=" c3-shape c3-shape-5 c3-circle c3-circle-5" r="2.5" style="fill: rgb(241, 196, 15); opacity: 0;" cx="230" cy="31.5"></circle><circle class=" c3-shape c3-shape-6 c3-circle c3-circle-6" r="2.5" style="fill: rgb(241, 196, 15); opacity: 0;" cx="275" cy="6.545454545454548"></circle></g></g></g><g class="c3-chart-arcs" transform="translate(137.5,26)"><text class="c3-chart-arcs-title" style="text-anchor: middle; opacity: 0;"></text></g><g class="c3-chart-texts"><g class="c3-chart-text c3-target c3-target-data1" style="opacity: 1; pointer-events: none;"><g class=" c3-texts c3-texts-data1"></g></g></g></g><g clip-path="url(https://preview.tabler.io/#c3-1564536960305-clip-grid)" class="c3-grid c3-grid-lines"><g class="c3-xgrid-lines"></g><g class="c3-ygrid-lines"></g></g><g class="c3-axis c3-axis-x" clip-path="url(https://preview.tabler.io/#c3-1564536960305-clip-xaxis)" transform="translate(0,62)" style="visibility: hidden; opacity: 1;"><text class="c3-axis-x-label" transform="" style="text-anchor: end;" x="275" dx="-0.5em" dy="-0.5em"></text><g class="tick" transform="translate(0, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="0"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">0</tspan></text></g><g class="tick" transform="translate(46, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">1</tspan></text></g><g class="tick" transform="translate(92, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">2</tspan></text></g><g class="tick" transform="translate(138, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">3</tspan></text></g><g class="tick" transform="translate(184, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">4</tspan></text></g><g class="tick" transform="translate(230, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">5</tspan></text></g><g class="tick" transform="translate(275, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="0"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">6</tspan></text></g><path class="domain" d="M0,6V0H275V6"></path></g><g class="c3-axis c3-axis-y" clip-path="url(https://preview.tabler.io/#c3-1564536960305-clip-yaxis)" transform="translate(0,0)" style="visibility: hidden; opacity: 1;"><text class="c3-axis-y-label" transform="rotate(-90)" style="text-anchor: end;" x="0" dx="-0.5em" dy="1.2em"></text><g class="tick" style="opacity: 1;" transform="translate(0,62)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">0</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,56)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">5</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,49)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">10</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,42)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">15</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,35)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">20</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,28)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">25</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,21)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">30</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,14)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">35</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,7)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">40</tspan></text></g><path class="domain" d="M0,1H0V62H0"></path></g><g class="c3-axis c3-axis-y2" transform="translate(275,0)" style="visibility: hidden; opacity: 1;"><text class="c3-axis-y2-label" transform="rotate(-90)" style="text-anchor: end;" x="0" dx="-0.5em" dy="-0.5em"></text><g class="tick" transform="translate(0,62)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0</tspan></text></g><g class="tick" transform="translate(0,56)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.1</tspan></text></g><g class="tick" transform="translate(0,50)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.2</tspan></text></g><g class="tick" transform="translate(0,44)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.3</tspan></text></g><g class="tick" transform="translate(0,38)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.4</tspan></text></g><g class="tick" transform="translate(0,32)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.5</tspan></text></g><g class="tick" transform="translate(0,26)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.6</tspan></text></g><g class="tick" transform="translate(0,20)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.7</tspan></text></g><g class="tick" transform="translate(0,14)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.8</tspan></text></g><g class="tick" transform="translate(0,8)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.9</tspan></text></g><g class="tick" transform="translate(0,1)" style="opacity: 1;"><line x2="6" y2="0"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">1</tspan></text></g><path class="domain" d="M6,1H0V62H6"></path></g></g><g transform="translate(-0.5,64.5)" style="visibility: hidden;"><g clip-path="url(https://preview.tabler.io/#c3-1564536960305-clip-subchart)" class="c3-chart"><g class="c3-chart-bars"></g><g class="c3-chart-lines"></g></g><g clip-path="url(https://preview.tabler.io/#c3-1564536960305-clip)" class="c3-brush" style="pointer-events: all; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><rect class="background" x="0" width="275" style="visibility: hidden; cursor: crosshair;"></rect><rect class="extent" x="0" width="0" style="cursor: move;"></rect><g class="resize e" transform="translate(0,0)" style="cursor: ew-resize; display: none;"><rect x="-3" width="6" height="6" style="visibility: hidden;"></rect></g><g class="resize w" transform="translate(0,0)" style="cursor: ew-resize; display: none;"><rect x="-3" width="6" height="6" style="visibility: hidden;"></rect></g></g><g class="c3-axis-x" transform="translate(0,0)" clip-path="url(https://preview.tabler.io/#c3-1564536960305-clip-xaxis)" style="visibility: hidden; opacity: 1;"><g class="tick" transform="translate(0, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="0"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">0</tspan></text></g><g class="tick" transform="translate(46, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">1</tspan></text></g><g class="tick" transform="translate(92, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">2</tspan></text></g><g class="tick" transform="translate(138, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">3</tspan></text></g><g class="tick" transform="translate(184, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">4</tspan></text></g><g class="tick" transform="translate(230, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">5</tspan></text></g><g class="tick" transform="translate(275, 0)" style="opacity: 1;"><line x1="0" x2="0" y2="0"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">6</tspan></text></g><path class="domain" d="M0,6V0H275V6"></path></g></g><g transform="translate(0,64)" style="visibility: hidden;"></g><text class="c3-title" x="137" y="0"></text></svg><div class="c3-tooltip-container" style="position: absolute; pointer-events: none; display: none; top: 17.25px; left: 19.5px;"><table class="c3-tooltip"><tbody><tr class="c3-tooltip-name--data1"><td class="name"><span style="background-color:#f1c40f"></span>Users online</td><td class="value">30</td></tr></tbody></table></div></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <script>--}}

{{--                        $(document).ready(function() {--}}
{{--                            var chart = c3.generate({--}}
{{--                                bindto: '#chart-bg-users-4',--}}
{{--                                padding: {--}}
{{--                                    bottom: -10,--}}
{{--                                    left: -1,--}}
{{--                                    right: -1--}}
{{--                                },--}}
{{--                                data: {--}}
{{--                                    names: {--}}
{{--                                        data1: 'Users online'--}}
{{--                                    },--}}
{{--                                    columns: [--}}
{{--                                        ['data1', 30, 40, 10, 40, 12, 22, 40]--}}
{{--                                    ],--}}
{{--                                    type: 'area'--}}
{{--                                },--}}
{{--                                legend: {--}}
{{--                                    show: false--}}
{{--                                },--}}
{{--                                transition: {--}}
{{--                                    duration: 0--}}
{{--                                },--}}
{{--                                point: {--}}
{{--                                    show: false--}}
{{--                                },--}}
{{--                                tooltip: {--}}
{{--                                    format: {--}}
{{--                                        title: function (x) {--}}
{{--                                            return '';--}}
{{--                                        }--}}
{{--                                    }--}}
{{--                                },--}}
{{--                                axis: {--}}
{{--                                    y: {--}}
{{--                                        padding: {--}}
{{--                                            bottom: 0,--}}
{{--                                        },--}}
{{--                                        show: false,--}}
{{--                                        tick: {--}}
{{--                                            outer: false--}}
{{--                                        }--}}
{{--                                    },--}}
{{--                                    x: {--}}
{{--                                        padding: {--}}
{{--                                            left: 0,--}}
{{--                                            right: 0--}}
{{--                                        },--}}
{{--                                        show: false--}}
{{--                                    }--}}
{{--                                },--}}
{{--                                color: {--}}
{{--                                    pattern: ['#f1c40f']--}}
{{--                                }--}}
{{--                            });--}}
{{--                        });--}}
{{--                </script>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
