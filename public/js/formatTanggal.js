function formatTanggal(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const currentDate = new Date(dateString);

    // Add 1 day to the current date
    // const nextDay = new Date(currentDate);
    // nextDay.setDate(currentDate.getDate() + 1);

    // Set the timezone to 'Asia/Jakarta' (Indonesian time)
    const formattedDate = currentDate.toLocaleDateString('id-ID', options);
    return formattedDate;
}