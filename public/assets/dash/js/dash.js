const segmentData = {
  labels: ["Segmento A", "Segmento B", "Segmento C", "Segmento D"],
  datasets: [
    {
      label: "Cadastros por Segmento",
      data: [120, 90, 60, 150],
      backgroundColor: [
        "rgba(75, 192, 192, 0.2)",
        "rgba(255, 99, 132, 0.2)",
        "rgba(255, 206, 86, 0.2)",
        "rgba(54, 162, 235, 0.2)",
      ],
      borderColor: [
        "rgba(75, 192, 192, 1)",
        "rgba(255, 99, 132, 1)",
        "rgba(255, 206, 86, 1)",
        "rgba(54, 162, 235, 1)",
      ],
      borderWidth: 1,
    },
  ],
};

const ctx = document.getElementById("segmentChart").getContext("2d");
new Chart(ctx, {
  type: "bar",
  data: segmentData,
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true, 
      },
    },
  },
});
