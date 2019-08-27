const fetchRangeData = async url => {
  fetch(url)
    .then(function(response) {
      return response.json();
    })
    .then(function(rangeDataJson) {
      fillSummaryData(rangeDataJson);
      fillChartData(rangeDataJson);
    });
};

const fillSummaryData = data => {
  const summaryItems = [
    "datestamp",
    "rangeStartDate",
    "rangeEndDate",
    "noOfOrders",
    "totalRevenue",
    "noOfCustomers"
  ];
  for (key of summaryItems) {
    let dItem = document.getElementById(key);
    if (dItem) {
      dItem.innerHTML = data[key];
    }
  }
};

const fillChartData = data => {
  const red = "rgb(255, 99, 132)";
  const blue = "rgb(54, 162, 235)";

  // let minYCustomerValue = Math.min(mostNegativeValue, options.ticks.suggestedMin);
  // let maxYCustomerValue = Math.max(mostPositiveValue, options.ticks.suggestedMax);
  // let minYOrderValue = Math.min(mostNegativeValue, options.ticks.suggestedMin);
  // let maxYOrderValue = Math.max(mostPositiveValue, options.ticks.suggestedMax);

  let minYCustomerValue = 200;
  let maxYCustomerValue = 400;
  let minYOrderValue = 100;
  let maxYOrderValue = 300;

  var config = {
    type: "line",
    data: {
      // labels: ["January", "February", "March", "April", "May", "June", "July"],
      labels: Object.keys(data.customersPerDay),
      datasets: [
        {
          label: "Customers",
          backgroundColor: red,
          borderColor: red,
          yAxisID: "customers",
          data: Object.values(data.customersPerDay),
          fill: false
        },
        {
          label: "Orders",
          fill: false,
          yAxisID: "orders",
          backgroundColor: blue,
          borderColor: blue,
          data: Object.values(data.ordersPerDay)
        }
      ]
    },
    options: {
      responsive: true,
      title: {
        display: true,
        text: "Sales Dashboard"
      },
      tooltips: {
        mode: "index",
        intersect: false
      },
      hover: {
        mode: "nearest",
        intersect: true
      },
      scales: {
        xAxes: [
          {
            display: true,
            scaleLabel: {
              display: true
              // labelString: "Day"
            }
          }
        ],
        yAxes: [
          {
            id: "orders",
            display: true,
            scaleLabel: {
              display: true,
              labelString: "Orders"
            },
            ticks: {
              suggestedMin: minYCustomerValue,
              suggestedMax: maxYCustomerValue
            }
          },
          {
            id: "customers",
            display: true,
            position: "right",
            scaleLabel: {
              display: true,
              labelString: "Customers"
            },
            ticks: {
              suggestedMin: minYOrderValue,
              suggestedMax: maxYOrderValue
            }
          }
        ]
      }
    }
  };
  var ctx = document.getElementById("canvas").getContext("2d");
  window.myLine = new Chart(ctx, config);
};

async function loadRangeData() {
  let data = fetchRangeData(config.rangeDataURL);
}
const config = {
  rangeDataURL: "http://localhost:8080/Dashboard/RangeData"
};
let vvv = 100;
