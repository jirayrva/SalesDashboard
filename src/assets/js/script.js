const fetchAndUpdateRangeData = async url => {
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
  let minYCustomerValue = Math.min(...Object.values(data.customersPerDay), 0);
  let maxYCustomerValue = Math.max(...Object.values(data.customersPerDay));
  let minYOrderValue = Math.min(...Object.values(data.ordersPerDay));
  let maxYOrderValue = Math.max(...Object.values(data.ordersPerDay));

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
              suggestedMin: minYOrderValue,
              suggestedMax: maxYOrderValue
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
              suggestedMin: minYCustomerValue,
              suggestedMax: maxYCustomerValue
            }
          }
        ]
      }
    }
  };
  var ctx = document.getElementById("canvas").getContext("2d");
  window.myLine = new Chart(ctx, config);
};

async function initRangeData() {
  let path = location.pathname.split("/");
  path.shift();
  path.shift();
  path.shift();
  let url = config.rangeDataURL;
  if (path[0]) url += "/" + path[0];
  if (path[1]) url += "/" + path[1];
  fetchAndUpdateRangeData(url);
}

const update = () => {
  //
  console.log("updating");
  let url = config.rangeDataURL;
  let from = document.getElementById("from").value;
  if (!from) return;
  url += `/${from}`;
  let to = document.getElementById("to").value;
  if (to) url += `/${to}`;
  fetchAndUpdateRangeData(url);
};

location.pathname;
const config = {
  rangeDataURL: "http://localhost:8080/Dashboard/RangeData"
};
let vvv = 100;
