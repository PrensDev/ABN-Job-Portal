
-- Display all procedure //testing purposes

SELECT 
  ROUTINE_NAME
FROM INFORMATION_SCHEMA.ROUTINES
WHERE ROUTINE_TYPE = 'PROCEDURE' --AND ROUTINE_NAME LIKE 'EMPL_%';
ORDER BY ROUTINE_NAME

----------------------------------------------------------------

-- View All Active Posts Procedure
CREATE PROCEDURE [VIEW_AllRecentPosts]
AS 
	SELECT [jobPostID] FROM [RecentPosts]
;

-- View Active Posts
CREATE PROCEDURE [VIEW_RecentPosts]
	@offsetRows		INT,
	@fetchedRows	INT
AS
	SELECT * FROM [RecentPosts]
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;
;

-- View Job Details Procedure
CREATE PROCEDURE [VIEW_JobDetails]
	@jobPostID	INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[dateModified]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [status]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
		, [Employers].[contactNumber]
		, [Employers].[email]
		, [Employers].[website]
	FROM [JobPosts]
	INNER JOIN [Employers]
	ON [JobPosts].[employerID] = [Employers].[employerID]
	AND [JobPosts].[jobPostID] = @jobPostID AND [JobPosts].[jobPostFlag] = 1
;

-- View Employer Details Procedure
CREATE PROCEDURE [VIEW_CompanyDetails]
	@employerID INT
AS
	SELECT
		  [employerID]
		, [profilePic]
		, [companyName]
		, [description]
		, [street] + ', ' + [brgyDistrict] + ', ' + [cityProvince] AS [location]
		, [contactNumber]
		, [email]
		, [website]
	FROM [Employers]
	WHERE [employerID] = @employerID
;

-- View All Available Jobs
CREATE PROCEDURE [VIEW_AllAvailableJobs]
	@employerID  INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [Employers].[employerID]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
	FROM [JobPosts]
	INNER JOIN [Employers] 
	ON [JobPosts].[employerID] = [Employers].[employerID]
	AND [JobPosts].[employerID] = @employerID
	AND [jobPostFlag] = 1
;

-- View Available Jobs
CREATE PROCEDURE [VIEW_AvailableJobs]
	@employerID  INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [JobPosts].[employerID] = @employerID
		AND [jobPostFlag] = 1
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;
;


-- Get All Search Result
CREATE PROCEDURE [VIEW_AllSearchResult]
	@jobTitle VARCHAR(MAX),
	@location VARCHAR(MAX)
AS
	SELECT [JobPosts].[jobPostID]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [jobPostFlag] = 1
	WHERE
		[JobPosts].[jobTitle] LIKE '%' + @jobTitle + '%'
		AND ([Employers].[brgyDistrict] LIKE '%' + @location + '%'
		OR [Employers].[cityProvince] LIKE '%' + @location + '%')
	ORDER BY [JobPosts].[dateCreated]
;


--  Get Search Result
CREATE PROCEDURE [VIEW_SearchResult]
	@jobTitle	 VARCHAR(MAX),
	@location	 VARCHAR(MAX),
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [jobPostFlag] = 1
	WHERE
		[JobPosts].[jobTitle] LIKE '%' + @jobTitle + '%'
		AND ([Employers].[brgyDistrict] LIKE '%' + @location + '%'
		OR [Employers].[cityProvince] LIKE '%' + @location + '%')
	ORDER BY [JobPosts].[dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;
;
